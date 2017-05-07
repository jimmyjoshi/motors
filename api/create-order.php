<?php

require_once('includes/apimaster.class.php');

$object = new API;


if(isset($_POST))
{
	$status = $object->createOrder($_POST);

	if($status)
	{
		$data = $_POST;

		$data['products'] = json_decode($data['products'], true);

		return $object->setResponse($data, 'Order Created Successfully', true);
	}
}
	return $object->setResponse('', 'Unable to create new Order', false);
?>
