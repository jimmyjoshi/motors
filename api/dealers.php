<?php

require_once('includes/apimaster.class.php');

$object = new API;

$dealers = $object->getApiDealers();

	if($dealers)
	{

		return $object->setResponse($dealers, 'Show Dealers', true);
	}
	
	return $object->setResponse('', 'Unable to Find Dealers', false);
?>
