<?php
require_once('includes/master.class.php');
$object = new Master;

if(isset($_GET['code']) && strlen($_GET['code']) > 5 )
{
	$status = $object->activateUserByCode($_GET['code']);
	
	if($status)
	{
		header("location:index.php?status=1");
		exit;
	}
	
	header("location:index.php");
}
?>
