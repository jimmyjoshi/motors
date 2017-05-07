<?php

require_once('includes/apimaster.class.php');

$object = new API;

$products = $object->getApiSalesExecutives();

	if($products)
	{

		return $object->setResponse($products, 'Show Sales Executives', true);
	}
	
	return $object->setResponse('', 'Unable to Find Dealers', false);
?>
