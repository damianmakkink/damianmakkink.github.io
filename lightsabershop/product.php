<?php
require 'vendor/autoload.php';
use Nahid\JsonQ\Jsonq;
?>

<!DOCTYPE html>
<html>
	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="css/main.css">
	</head>
	<body id="top">

		<?php include("inc/nav.php"); ?>

		<section id="single-product" data-aos="fade-in" data-aos-delay="150">
			<div class="container product-view mt-6">
				<?php
					$data = new Jsonq('data/sabers.json');
					$sabers = $data->from('sabers')
						->where('id', '=', $_GET['id'])
						->get();
					$sabers = array_merge(array($key => $value) + $sabers );

					$planetID = $sabers[0]['crystal']['planet'];
					$swapi = file_get_contents('http://swapi.co/api/planets/'.$planetID);
					$planet = json_decode($swapi, true);

					$price = $sabers[0]['crystal']['credit']*($sabers[0]['crystal']['usage']*100);
				?>

					<div class="row">
						<div class="col-md-6 mb-5 mb-md-0">
							<div class="product-thumbnail">
								<img src="img/sabers/<?php echo $sabers[0]['image']; ?>" class="img-fluid product-image mb-4">
							</div>
						</div>
						<div class="col-md-6 product">
							<h2 class="mb-4"><?php echo $sabers[0]['name']; ?></h2>
							<div class="product-wrapper mb-4">
								<p class="product-desc mb-4"><?php echo $sabers[0]['description']; ?></p>
								<div class="crystal-info">
									<h5>Crystal information</h5>
									<ul>
										<li><strong>Name: </strong><?php echo $sabers[0]['crystal']['name']; ?></li>
										<li><strong>Color: </strong><?php echo $sabers[0]['crystal']['color']; ?></li>
										<li><strong>Power usage: </strong><?php echo $sabers[0]['crystal']['usage']*100; ?>%F</li>
										<li><strong>Planet: </strong><?php echo $planet['name']; ?></li>
									</ul>
								</div>
								<div class="power-usage mb-4">
									<h5>Calculate power usage</h5>
									<div class="result">
										<input type="number" placeholder="Please enter your age" class="age" min="0">
										<input type="hidden" name="crystalUsage" class="crystalUsage" value="<?php echo $sabers[0]['crystal']['usage']; ?>">
										<span class="amount">0</span>
										<span class="force">F</span>
									</div>
								</div>
								<span class="stock">
									<?php if($sabers[0]['available'] > 0): ?>
									In stock: <span><?php echo $sabers[0]['available'] ?></span>
									<?php else: ?>
									Out of stock!
									<?php endif; ?>
								</span>
								<span class="credits"><span>Price: </span><?php echo $price; ?>Cr</span>
							</div>
							<?php if($sabers[0]['available'] > 0): ?>
							<a href="/order.php?id=<?php echo $sabers[0]['id']; ?>" class="btn btn-primary">Order this saber</a>
							<?php endif; ?>
						</div>
					</div>
			</div>
		</section>

		<?php include("inc/scripts.php"); ?>

		<script>
			$("input.age").on("change paste keyup", function() {
				var age = $(this).val();
				if (age >= 140) {
					alert('You have been dissolved in the force!');
				}
				var force = age * 10;
				var crystalUsage = $(this).parent().find('.crystalUsage').val();
				var powerUsage = crystalUsage * force;
				$('.result .amount').text(powerUsage);
			});
		</script>
	</body>
</html>