<?php

require_once('includes/apimaster.class.php');

$object = new API;

if(isset($_POST))
{
	$userId = $_POST['user_id'];
	
	$status = $object->flushToken($userId);

	if($status)
	{
		$response = [
			'user_id' 	=> $userId
		];

		return $object->setResponse($response, 'User Token Flush', true);
	}
}

return $object->setResponse('', 'Unable to Set Flush User Token', false);
?>
