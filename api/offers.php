<?php

require_once('includes/apimaster.class.php');

$object = new API;

if(isset($_REQUEST))
{
	$userId = $_REQUEST['user_id'];
	
	$offers = $object->getApiOffers($userId);

	if($offers)
	{
		return $object->setResponse($offers, 'Show Offers', true);
	}
}
	
	return $object->setResponse('', 'Unable to Find Offers', false);
?>
