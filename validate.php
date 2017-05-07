<?php
require_once('includes/master.class.php');

if(isset($_POST))
{
	$object = new Master;
	
	$emailid 	= $_POST['emailid'];
	$password 	= md5($_POST['password']);

	$user = $object->login($emailid, $password);
	if($user)
	{
		$_SESSION['user_id'] = $user['id'];
		$_SESSION['first_name'] = $user['first_name'];
		$_SESSION['last_name'] = $user['last_name'];
		$_SESSION['email_id'] = $user['email_id'];
		$_SESSION['role'] = $user['role'];
		
		
		header("location:dashboard.php");
		exit;
	}
	
	header("location:index.php?status=0");
}

