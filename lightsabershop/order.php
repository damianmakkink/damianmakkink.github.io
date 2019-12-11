<?php
if(!$_GET['id']) {
	header("location: shop.php");
}
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

		<section id="order" data-aos="fade-in" data-aos-delay="150">
			<div class="container product-view my-6">
				<h2 class="mb-4 text-center">Please review your order</h2>
				<div class="row">
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

					
					<div class="col-md-6 product">
						<div class="product-wrapper mb-4">
							<div class="product-thumbnail">
								<img src="img/sabers/<?php echo $sabers[0]['image']; ?>" class="img-fluid product-image mb-4">
							</div>
							<h3><?php echo $sabers[0]['name']; ?></h3>
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
							<span class="credits"><span>Price: </span><?php echo $price; ?>Cr</span>
						</div>
					</div>
					<div class="col-md-6">
							<form method="post" action="checkout.php?id=<?php echo $sabers[0]['id']; ?>">
								<div class="form-group">
									<label for="username">Your name*:</label>
									<input type="text" class="form-control" id="name" name="name" required>
								</div>
								<div class="form-group">
									<label for="email">Your email address*:</label>
									<input type="email" class="form-control" id="email" name="email" required>
								</div>
								<div class="form-group">
									<label for="address">Where should we (space)ship the Lightsaber to?*</label>
									<input type="text" class="form-control" id="address" name="address" required>
								</div>
								<button type="submit" class="btn btn-primary">Submit order</button>
								<input type="hidden" name="saber_name" value="<?php echo $sabers[0]['name']; ?>">
								<input type="hidden" name="saber_price" value="<?php echo $price; ?>">
								<input type="hidden" name="saber_crystal" value="<?php echo $sabers[0]['crystal']['name'] ?>">
							</form>
						
					</div>
				</div>
			</div>
		</section>

		<?php include("inc/scripts.php"); ?>
	</body>
</html>