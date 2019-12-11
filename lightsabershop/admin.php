<?php
include("config/session.php");

require 'vendor/autoload.php';
use Nahid\JsonQ\Jsonq;
?>

<!DOCTYPE html>
<html>
	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
		<link rel="stylesheet" href="css/main.css">

	</head>
	<body id="top" class="page-admin">

		<?php
		include("inc/nav.php");
		?>

		<section id="admin" data-aos="fade-in" data-aos-delay="150">
			<div class="container my-6">
				<h2 class="mb-4 text-center">Welcome, <?php echo $_SESSION['user']; ?></h2>
				<div class="row mb-6">
					<div class="col">
						<h5>Order overview</h5>
						<div class="table-responsive">
							<table id="orderTable" class="table">
								<thead>
									<tr>
									<th scope="col">ID</th>
									<th scope="col">Date</th>
									<th scope="col">Saber name</th>
									<th scope="col">Saber price</th>
									<th scope="col">Customer name</th>
									<th scope="col">Customer email</th>
									<th scope="col">Customer address</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sql = "SELECT * FROM orders";
									$result = mysqli_query($db, $sql);

									if ($result->num_rows > 0):
										while($row = $result->fetch_assoc()): ?>
										<tr>
											<th scope="row"><?php echo $row["id"]; ?></th>
											<td><?php echo $row["date"]; ?></td>
											<td><?php echo $row["saber_name"]; ?></td>
											<td><?php echo $row["saber_price"]; ?></td>
											<td><?php echo $row["customer_name"]; ?></td>
											<td><?php echo $row["customer_email"]; ?></td>
											<td><?php echo $row["customer_address"]; ?></td>
										</tr>
										<?php
										endwhile; 
									else:
										echo "There have not been any orders yet.";
									endif;
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<h5>Stock overview</h5>
						<?php
						$products = new Jsonq('data/sabers.json');
						$data = $products->from('sabers')->get();
						$object = json_decode(json_encode($data), FALSE);
						?>

						<div class="table-responsive">
							<table id="stockTable" class="table">
								<thead>
									<tr>
										<th scope="col">ID</th>
										<th scope="col">Saber name</th>
										<th scope="col">Available stock</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$count = 0;
									foreach ($object as $product): ?>
									<tr>
										<th scope="row"><?php echo $product->id; ?></th>
										<td><?php echo $product->name; ?></td>
										<td><?php echo $product->available; ?><button type="button" class="btn btn-primary editStock" data-toggle="modal" data-target="#editStockModal" data-stock="<?php echo $product->available; ?>" data-saber="<?php echo $product->name; ?>" data-array="<?php echo $count; ?>">Edit</button></td>
									</tr>
									<?php $count++; endforeach; ?>
								</tbody>
							</table>
						</div>

					</div>
				</div>
			</div>
		</section>

		<div id="editStockModal" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Edit stock</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form id="editStockForm" method="post">
						<div class="modal-body">
							<div class="form-group">
								<label for="username">Enter stock amount:</label>
								<input type="number" class="form-control" id="stock" name="stock" min="0" required>
								<input type="hidden" name="array" value="">
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Save changes</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<?php include("inc/scripts.php"); ?>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
		<script>
			$(document).ready( function () {

				$('#orderTable, #stockTable').DataTable();
				$('button.editStock').click(function (e) { 
					var saber = $(this).data('saber');
					var array = $(this).data('array');
					$('#editStockModal strong.saber').text(saber);
					$('#editStockModal input[name="array"]').val(array);
				});

				$('#editStockForm').submit(function(e) {
					e.preventDefault();
					$.ajax({
						type: "POST",
						url: 'config/editStock.php',
						data: $(this).serialize(),
						success: function(response) {
							var jsonData = JSON.parse(response);

							if (jsonData.success == "1") {
								location.reload();
							}
							else {
								alert('Please enter a stock amount.');
							}
						}
					});
				});

			});
		</script>

	</body>
</html>