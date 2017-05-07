<?php
require_once('includes/master.class.php');
$object = new Master;

$status = $object->validateSession();

if(isset($_POST))
{
	$data = $_POST;
	
	$status = $object->createProduct($data);
	
	if($status)
	{
		header('location: products.php?msg=1');
		exit;
	}
}

header('location: products.php?msg=0');
exit;

?>