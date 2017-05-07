<?php
require_once('includes/master.class.php');
$object = new Master;

$status = $object->validateSession();

if(isset($_POST))
{
	$id = $_POST['id'];
	
	$status = $object->removeUserById($id);
	
	if($status)
	{
		echo json_encode(array(
			'status' => true
		));
		die;
	}
	
	echo json_encode(array(
			'status' => false
		));
		die;
}
