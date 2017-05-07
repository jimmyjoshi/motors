<?php
require_once('includes/master.class.php');
$object = new Master;

$status = $object->validateSession();
if(isset($_POST) && count($_POST) > 1)
{
	if($_POST['profiletype'] == 'normal')
	{
		$status = $object->updateUserProfile($_POST);
	}
	else
	{
		$status = $object->updateUserPassword($_POST);	
	}
	if($status)
	{
		header("location: edit-user.php?msg=1");
		exit;
	}
	header("location: edit-user.php?msg=0");
	exit;
}
?>