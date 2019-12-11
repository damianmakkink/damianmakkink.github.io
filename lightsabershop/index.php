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
		<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
		<link rel="stylesheet" href="css/main.css">
	</head>
	<body id="top">

		<?php include("inc/nav.php"); ?>

		<section id="welcome" data-aos="fade-in" data-aos-delay="150">
			<div class="container mt-6">
				<div class="row">
					<div class="col text-center">
						<h1>Greetings, Padawan!</h1>
						<h4>What would you like to do?</h4>
						<p>to do: checkout mail</p>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col text-center tiles">
						<a href="/shop.php" class="btn btn-primary tile">
							Browse all Lightsabers
						</a>
					</div>
				</div>
			</div>
		</section>

		<section id="products" data-aos="fade-in" data-aos-delay="150">
			<div class="container mt-6">
				<h2 class="mb-4">Popular Lightsabers</h2>
				<div class="row">

					<?php
					$data = new Jsonq('data/sabers.json');
					$sabers = $data->from('sabers')
						->where('popular', '=', true)
						->get();
					$object = json_decode(json_encode($sabers), FALSE);

					foreach ($object as $product): ?>
						<div class="col-lg-4 mb-5 mb-lg-0 product">
							<div class="product-wrapper">
								<img src="img/sabers/<?php echo $product->image; ?>" class="img-fluid product-image mb-4">
								<h5 class="product-title"><?php echo $product->name; ?></h5>
								<p class="product-desc mb-4"><?php echo $product->description; ?></p>
								<a href="/product.php?id=<?php echo $product->id; ?>" class="btn btn-primary">View saber</a>
							</div>
						</div>
					<?php endforeach; ?>

				</div>
			</div>
		</section>

		<?php include("inc/scripts.php"); ?>

	</body>
</html>