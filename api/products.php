<?php

require_once('includes/apimaster.class.php');

$object = new API;

$products = $object->getApiProducts();

	if($products)
	{

		return $object->setResponse($products, 'Show Products', true);
	}
	
	return $object->setResponse('', 'Unable to Find Products', false);
?>
