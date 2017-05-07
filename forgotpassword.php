<?php
require_once('includes/master.class.php');
$object = new Master;
$status = $object->checkUser();

if($status)
{
	header("location: dashboard.php");
}

$emailId = $_POST['emailid'];
$stauts = $object->forgotPasswordProcess($emailId);
if($stauts)
{
	header("location:forgot-password.php?status=1");
	exit;
}

header("location:forgot-password.php?status=0");
exit;
?>