<?php
require '../vendor/autoload.php';
use Nahid\JsonQ\Jsonq;

if (isset($_POST['stock']) && isset($_POST['array'])) {

	$products = new Jsonq('../data/sabers.json');
	$data = $products->get();
	$object = json_decode(json_encode($data), FALSE);

	$newStock = $_POST['stock'];
	$arrayNumber = $_POST['array'];

	$data['sabers'][$arrayNumber]['available'] = $newStock;

	$newData = json_encode($data);
 	file_put_contents('../data/sabers.json', $newData);

 	echo json_encode(array('success' => 1));

} else {
	echo json_encode(array('success' => 0));
}
?>