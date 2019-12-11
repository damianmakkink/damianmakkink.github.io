<?php
include("config/db.php");
session_start();

if(isset($_SESSION['user'])){
	header("location: admin.php");
}

if($_POST) {
	
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']); 
	
	$sql = "SELECT id FROM admin_users WHERE username = '$username' AND password = '$password'";
	$result = mysqli_query($db, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$active = $row['active'];

	$count = mysqli_num_rows($result);
		
	if($count == 1) {
		$_SESSION['user'] = $username;
		header("location: admin.php");
	} else {
		$error = "Username or password is incorrect.";
	}
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

		<section id="login" data-aos="fade-in" data-aos-delay="150">
			<div class="container mt-5">
				<div class="row justify-content-center">
					<div class="col-md-5">
						<form method="post">
							<div class="form-group">
								<label for="username">Username:</label>
								<input type="text" class="form-control" id="username" name="username" aria-describedby="username">
							</div>
							<div class="form-group">
								<label for="password">Password:</label>
								<input type="password" class="form-control" id="password" name="password">
							</div>
							<button type="submit" class="btn btn-primary">Login</button>
						</form>
						<div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					</div>
				</div>
			</div>
		</section>

		<?php include("inc/scripts.php"); ?>

	</body>
</html>