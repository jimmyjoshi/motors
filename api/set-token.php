<?php

require_once('includes/apimaster.class.php');

$object = new API;

if(isset($_POST))
{
	$userId = $_POST['user_id'];
	$token 	= $_POST['token'];

	$status = $object->setToken($userId, $token);

	if($status)
	{
		$response = [
			'user_id' 	=> $userId,
			'token'		=> $token
		];

		return $object->setResponse($response, 'User Token Updated', true);
	}
}

return $object->setResponse('', 'Unable to Set User Token', false);
?>
