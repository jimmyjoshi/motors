<?php

require_once('includes/apimaster.class.php');

$object = new API;


if(isset($_POST))
{
	$status = $object->sendMessage($_POST);

	if($status)
	{
		$data = $_POST;

		return $object->setResponse($data, 'Message Send Successfully', true);
	}
}
	return $object->setResponse('', 'Unable to Send Message', false);
?>
