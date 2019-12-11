<?php
require 'vendor/autoload.php';
include("config/db.php");

if(!$_GET['id']) {
	header("location: shop.php");
} else if ($_POST) {
	$sql = "INSERT INTO orders (saber_name, saber_price, customer_name, customer_email, customer_address)
	VALUES ('".$_POST["saber_name"]."', '".$_POST["saber_price"]."', '".$_POST["name"]."', '".$_POST["email"]."', '".$_POST["address"]."')";

	if ($db->query($sql) === FALSE) {
		echo "Error: " . $sql . "<br>" . $db->error;
	}

	include("inc/orderMail.php");
}
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

		<section id="checkout" data-aos="fade-in" data-aos-delay="150">
			<div class="container my-6">
				<h2 class="mb-3 text-center">Thank you for your order</h2>
				<h5 class="text-center">A confirmation email has been sent to <span class="gold"><?php echo $_POST['email']; ?></span></h5>
				<div class="row justify-content-center mt-5">
					
					<div class="col-md-4">
						<h5>Your information</h5>
						<ul>
							<li><strong>Name: </strong><?php echo $_POST['name']; ?></li>
							<li><strong>Email address: </strong><?php echo $_POST['email']; ?></li>
							<li><strong>Address: </strong><?php echo $_POST['address']; ?></li>
						</ul>
					</div>
					<div class="col-md-4">
						<h5>Your order</h5>
						<ul>
							<li><strong>Lightsaber: </strong><?php echo $_POST['saber_name']; ?></li>
							<li><strong>Crystal: </strong><?php echo $_POST['saber_crystal']; ?></li>
							<li><strong>Price: </strong><?php echo $_POST['saber_price']; ?></li>
						</ul>
					</div>
				</div>
			</div>
		</section>

		<?php include("inc/scripts.php"); ?>
	</body>
</html>