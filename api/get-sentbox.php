<?php

require_once('includes/apimaster.class.php');

$object = new API;
$userId = $_POST['user_id'] ? $_POST['user_id']  : 0;

$messages = $object->getAPISentBoxByUserId($userId);

	if(is_array($messages) && count($messages))
	{
		return $object->setResponse($messages, 'Get All Sent Messages', true);
	}
	return $object->setResponse([], 'Unable to get Sent Messages', false);
?>
