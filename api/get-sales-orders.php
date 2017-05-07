<?php

require_once('includes/apimaster.class.php');

$object = new API;
$userId = $_POST['user_id'] ? $_POST['user_id']  : 0;

$orders = $object->getAPIOrdersBySalesId($userId);

	if(is_array($orders) && count($orders))
	{
		return $object->setResponse($orders, 'Get All Orders', true);
	}
	return $object->setResponse('', 'Unable to get Orders', false);
?>
