<?php
require_once('includes/master.class.php');
$object = new Master;

$status = $object->validateSession();

if(isset($_POST))
{
	$data = $_POST;

	$status = $object->updateSalesExecutive($data);

	if($status)
	{
		header('location: users.php?msg=1');
		exit;
	}
}

header('location: users.php?msg=0');
exit;

?>