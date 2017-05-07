<?php

require_once('includes/apimaster.class.php');

$object = new API;

if(isset($_POST))
{
	$username = $_POST['username'];
	$password = $_POST['password'];

	$userInfo = (object) $object->login($username, $password);

	if($userInfo && isset($userInfo->email_id) && $userInfo->status == 1 && $userInfo->role != 1)
	{
		$response = [
			'user_id' 			=> $userInfo->id,
			'first_name' 		=> $userInfo->first_name,
			'last_name'	 		=> $userInfo->last_name,
			'email_id' 			=> $userInfo->email_id,
			'mobile' 			=> $userInfo->mobile,
			'add1' 				=> $userInfo->add1,
			'add2' 				=> $userInfo->add2,
			'add3' 				=> $userInfo->add3,
			'city' 				=> $userInfo->city,
			'telephone' 		=> $userInfo->tel,
			'area' 				=> $userInfo->area,
			'tinno' 			=> $userInfo->tinno,
			'status' 			=> $userInfo->status,
			'role'				=> $userInfo->role,
			'profile_picture' 	=> 'http://'.$_SERVER['HTTP_HOST'] .'/api/uploads/'.$userInfo->profile_picture,
			'created_at'		=> $userInfo->created_at
		];

		return $object->setResponse($response, 'User Login Successfully', true);
	}

	return $object->setResponse('', 'Unable to Login User not Found or Inactive', false);
}
?>
