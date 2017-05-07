<?php
require_once('includes/master.class.php');
$object = new Master;

$status = $object->validateSession();

if(isset($_POST) && isset($_POST['productId']))
{
	$data 		= $_POST;
	$productId 	= $_POST['productId'];
	$status = $object->updateProduct($productId, $data);
	
	if($status)
	{
		header('location: products.php?msg=2');
		exit;
	}
}

header('location: products.php?msg=0');
exit;

?>