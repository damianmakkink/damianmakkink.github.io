<?php
	$db = mysqli_connect('s193.webhostingserver.nl:3306', 'deb81080_saberdbu', 'gAjlk5R2', 'deb81080_saberdb');
	if (!$db) {
		echo "Error: Unable to connect to MySQL." . PHP_EOL;
		echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}
?>