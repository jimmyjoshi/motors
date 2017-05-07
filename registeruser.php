<?php
require_once('includes/master.class.php');

if(isset($_POST))
{
	$object = new Master;
	
	$isExists = $object->getUserByEmailId($_POST['email_id']);

	if( ! $isExists)
	{
		$userId = $object->signup($_POST);

		if($userId)
		{
			$status = $object->sendConfirmationEmail($userId);
		}

		header("location:index.php?status=5");
		exit;
	}
	
	header("location:index.php?status=3");
	exit;
}

