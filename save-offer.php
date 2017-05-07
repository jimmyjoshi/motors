<?php
require_once('includes/master.class.php');
$object = new Master;

$status = $object->validateSession();

if(isset($_POST))
{
	$data = $_POST;
	
	$status = $object->createOffer($data);
	
	if($status)
	{
		header('location: offers.php?msg=1');
		exit;
	}
}

header('location: offers.php?msg=0');
exit;

?>