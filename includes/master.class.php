<?php
session_start();

class Master
{
	protected $host = "localhost";
	
	protected $username = "mmotors";
	
	protected $password = "Admin@123";
	
	protected $db = "mmotors";
	
	public function __construct()
	{
		$connection = mysql_connect($this->host, $this->username, $this->password);
		
		mysql_select_db($this->db, $connection);
	}
		
	public function checkUser()
	{
		if(isset($_SESSION['user_id']))
		{
			return true;
		}
		
		return false;
	}
	
	public function validateSession()
	{
		if(!isset($_SESSION['user_id']))
		{
			echo '<script>window.location.assign("index.php");</script>';
		}
	}
	public function clearSession()
	{
		unset($_SESSION['user_id']);
		unset($_SESSION['first_name']);
		unset($_SESSION['last_name']);
		unset($_SESSION['email_id']);
		unset($_SESSION['role']);
		
		return true;
	}
	
	public function signup($data)
	{
		$first_name = $data['first_name'];
		$last_name 	= $data['last_name'];
		$email_id 	= $data['email_id'];
		$password 	= md5($data['password']);
		$username  	= $data['first_name'];
		$nickname  	= $data['nick_name'];
		
		$sql = 'INSERT INTO users (first_name, last_name, nickname,username, email_id, password)
				VALUES("'.$first_name.'","' .$last_name. '",  "'. $nickname .'", "'. $username .'", "'.$email_id.'", "'. $password .'")';
				
		$status = mysql_query($sql);
		
		if($status)
		{
			return mysql_insert_id();
		}
		
		return false;
	}
	public function login($emailid, $password)
	{
		if($emailid && $password)
		{
			$sql = 'SELECT * FROM users 
						WHERE 
						password = "'. $password .'"
						AND
						email_id = "' .$emailid. '"
						AND
						status = 1';
						
			$query 	= mysql_query($sql);
			$data 	= mysql_fetch_assoc($query);
			
			if($data)
			{
				return $data;
			}
			
			return false;
		}
	}
	
	public function sendConfirmationEmail($userId)
	{
		$code = md5(time());
		
		$sql = 'UPDATE users SET activation_code = "'.$code.'"
				WHERE id = "'.$userId.'"';
				
		$status = mysql_query($sql);	
		
		$userInfo = $this->getUserById($userId);
		
		$name = $userInfo['first_name'] . ' '.$userInfo['last_name'];
		
		$html = $this->prepareSignupEmailContent($name,  $code);
		
		$status = $this->sendEmail($userInfo['email_id'], 'admin@admin.com', 'Confirm your Account', $html);
		
		if($status)
		{
			return true;
		}
		
		return false;
	}
	
	public function prepareSignupEmailContent($username, $code)
	{
		$html = 'Hello '.$username.', <br> Please click on Below Link to Activate your Account<br>
				<a href="http://'.$_SERVER['HTTP_HOST'].'/app/activate.php?code='. $code .'">Click Here to Activate Account</a>';
		return $html;
	}
	
	public function sendEmail($to, $from, $subject, $content)
	{
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <'. $from .'>' . "\r\n";
		//$headers .= 'Cc: myboss@example.com' . "\r\n";

		if(mail($to, $subject, $content, $headers))
		{
			return true;
		}
		
		return false;
	}
	
	public function getUserById($userId)
	{
		$sql = 'SELECT * FROM users 
						WHERE 
						id = "'.$userId.'"';
		$query 	= mysql_query($sql);
		
		if($query)
		{
			return mysql_fetch_assoc($query);
		}
		
		return false;
	}

	public function getUserByEmailId($emailId)
	{
		$sql = 'SELECT * FROM users 
						WHERE 
						email_id = "'.$emailId.'"';
		$query 	= mysql_query($sql);
		
		if($query)
		{
			return mysql_fetch_assoc($query);
		}
		
		return false;
	}
		
	public function activateUserByCode($code)
	{
		$sql = 'UPDATE users 
				SET 
				status = 1,
				activation_code = NULL
				WHERE activation_code = "'.$code.'"';
		
		return mysql_query($sql);
	}
	
	public function getAllMedia($type = 'image')
	{
		if($_SESSION['role'] == 1)
		{
			$sql = 'SELECT uploaded_media.*, users.first_name,users.last_name FROM uploaded_media
				LEFT JOIN users
				ON users.id = uploaded_media.user_id
				WHERE
				category = "'.$type.'"
				order by id DESC';

		}
		else
		{
			$userId =  $_SESSION['user_id'];

			$sql = 'SELECT uploaded_media.*, users.first_name,users.last_name FROM uploaded_media
				LEFT JOIN users
				ON users.id = uploaded_media.user_id
				WHERE
					user_id = "'.$userId.'"
				AND
					category = "'.$type.'"
				order by id DESC';
		}

		$query = mysql_query($sql);
		
		$result = array();
		
		while($row = mysql_fetch_assoc($query))
		{
			$result[] = $row;
		}
		
		return $result;
	}
	
	public function removeMediaById($id)
	{
		$sql 	= 'SELECT * FROM uploaded_media WHERE id = "'.$id.'"';
		$query 	= mysql_query($sql);
		$data 	= mysql_fetch_assoc($query);
		
		$status = $this->removePhysicalMedia($data['user_id'], $data['media_name']);
		
		if($status)
		{
			$sql = 'DELETE FROM uploaded_media WHERE id = "'.$id.'"';
			return mysql_query($sql);
		}
		
		return false;
	}
	
	public function removePhysicalMedia($userId, $media)
	{
		$filePath = 'media'. DIRECTORY_SEPARATOR. $userId . DIRECTORY_SEPARATOR . $media;
		
		if(file_exists($filePath))
		{
			unlink($filePath);
		}
		
		return true;
	}

	public function checkOrMakeDir($filePath)
	{
		if(is_dir($filePath))
		{
			return true;
		}

		mkdir($filePath, 0777, true);

		return true;
	}

	public function createMedia($data)
	{
		$sql = 'INSERT INTO uploaded_media (user_id, category, title, media_name, created_at)
				VALUES("'.$_SESSION['user_id'].'", "'.$data['category'].'", "'.$data['title'].'",
				"'.$data['media_name'].'", "'. date('Y-m-d H:i:s') .'")';
		return mysql_query($sql);
	}

	/*public function getUserByEmailId($emailId = null)
	{
		if($emailId)	
		{
			$sql = 'SELECT id FROM users WHERE email_id = "'.$emailId.'"';

			$query = mysql_query($sql);

			if(mysql_fetch_assoc($query))
			{
				return true;
			}
		}

		return false;
	}*/

	public function getUserDashboardStatstics($userId = null)
	{
		if(! $userId)
		{
			$userId = $_SESSION['user_id'];
		}
		
		$sql = 'SELECT 
				(select count(id) from uploaded_media where user_id  = '.$userId.' AND category = "image") as image_count,
				(select count(id) from uploaded_media where user_id  = '.$userId.' AND category = "graphic") as graphic_count,
				(select count(id) from uploaded_media where user_id  = '.$userId.' AND category = "video") as video_count
 				FROM uploaded_media LIMIT 0,1';

 		$query = mysql_query($sql);	

 		return mysql_fetch_assoc($query);
	}

	public function getAdminDashboardStatstics()
	{
		$sql = 'SELECT 
				(select count(id) from users where role = 2) as executives,
				(select count(id) from users where role = 3) as dealers
 				FROM uploaded_media LIMIT 0,1';

 		$query = mysql_query($sql);	

 		return mysql_fetch_assoc($query);
	}

	public function forgotPasswordProcess($emailId = null)
	{
		if($emailId)
		{
			$userInfo 	= $this->getUserByEmailId($emailId);
			$password 	= $this->generateRandomPassword(6);
			$sql 		= 'UPDATE users SET password = "'.md5($password).'" WHERE id = "'.$userInfo['id'].'"';
			mysql_query($sql);

			$name 		= $userInfo['first_name'] . ' '.$userInfo['last_name'];
			$html 		= $this->prepareForgotPasswordEmailContent($name,  $password);
			
			$status = $this->sendEmail($userInfo['email_id'], 'admin@admin.com', 'Reset Password', $html);
			
			if($status)
			{
				return true;
			}
		}

		return false;
	}

	public function prepareForgotPasswordEmailContent($username, $password)
	{
		$html = 'Hello '.$username.', <br> We have reset your Details Please find below details to login.<br>
				New Password : <strong>'.$password.'</strong>';

		return $html;
	}

	public function generateRandomPassword($length = 6) 
	{
	    $alphabets = range('A','Z');
	    $numbers = range('0','9');
	    $additional_characters = array('_','.');
	    $final_array = array_merge($alphabets,$numbers,$additional_characters);
	         
	    $password = '';
	  
	    while($length--) 
	    {
	    	$key = array_rand($final_array);
	      	$password .= $final_array[$key];
	    }
  
    	return $password;
  	}

  	public function getAllPaintigsFrontEnd()
  	{
  		$sql = 'SELECT uploaded_media.*, users.first_name, users.last_name FROM uploaded_media
				LEFT JOIN users ON users.id = uploaded_media.user_id
				WHERE  uploaded_media.category = "image" AND users.status = 1
				order by users.username, uploaded_media.id DESC';

		$query = mysql_query($sql);
		
		$result = array();
		
		while($row = mysql_fetch_assoc($query))
		{
			$result[] = $row;
		}
		
		return $result;
	}

	public function getAllGraphicsFrontEnd()
  	{
  		$sql = 'SELECT uploaded_media.*, users.first_name, users.last_name FROM uploaded_media
				LEFT JOIN users ON users.id = uploaded_media.user_id
				WHERE  uploaded_media.category = "graphic" AND users.status = 1
				order by users.username, uploaded_media.id DESC';

		$query = mysql_query($sql);
		
		$result = array();
		
		while($row = mysql_fetch_assoc($query))
		{
			$result[] = $row;
		}
		
		return $result;
	}

	public function getAllVideosFrontEnd()
  	{
  		$sql = 'SELECT uploaded_media.*, users.first_name, users.last_name FROM uploaded_media
				LEFT JOIN users ON users.id = uploaded_media.user_id
				WHERE  uploaded_media.category = "video" AND users.status = 1
				order by users.username, uploaded_media.id DESC';

		$query = mysql_query($sql);
		
		$result = array();
		
		while($row = mysql_fetch_assoc($query))
		{
			$result[] = $row;
		}
		
		return $result;
	}

	public function getAllMediaForFrontEndByCategory($category = 'image')
  	{
  		$sql = 'SELECT uploaded_media.*, users.first_name, users.last_name, users.nickname FROM uploaded_media
				LEFT JOIN users ON users.id = uploaded_media.user_id
				WHERE  uploaded_media.category = "'.$category.'" AND users.status = 1
				order by users.username, uploaded_media.id DESC';

		$query = mysql_query($sql);
		
		$result = array();
		
		while($row = mysql_fetch_assoc($query))
		{
			$result[] = $row;
		}
		
		return $result;
	}

	public function getAllUsers()
	{
		$sql 	= 'SELECT * FROM users WHERE role = 0 order by first_name';
		$query 	= mysql_query($sql);
		$result = array();
		
		while($row = mysql_fetch_assoc($query))
		{
			$result[] = $row;
		}
		
		return $result;
	}


	public function getAllSalesExecutives()
	{
		$sql 	= 'SELECT * FROM users WHERE role = 2 order by first_name';
		$query 	= mysql_query($sql);
		$result = array();
		
		while($row = mysql_fetch_assoc($query))
		{
			$result[] = $row;
		}
		
		return $result;
	}

	public function getAllDealers()
	{
		$sql 	= 'SELECT * FROM users WHERE role = 3 order by first_name';
		$query 	= mysql_query($sql);
		$result = array();
		
		while($row = mysql_fetch_assoc($query))
		{
			$result[] = $row;
		}
		
		return $result;
	}

	public function removeUserById($userId = null)
	{
		if($userId)
		{
			$sql = 'DELETE FROM users WHERE id = "'.$userId.'"';
			
			return mysql_query($sql);
		}

		return false;
	}

	public function updateUserStatusById($userId = null, $status = 1) 
	{
		if($userId)
		{
			$sql = 'UPDATE users SET status= "'.$status.'", activation_code = NULL WHERE id = "'.$userId.'"';

			return mysql_query($sql);	
		}
		
		return false;
	}

	public function getCleanTitle($title = null)
	{
		if($title)
		{
			return str_replace('_', ' ', $title);
		}

		return $title;
	}

	public function updateUserProfile($input = array())
	{
		$sql = 'UPDATE users SET
				first_name = "'.$input['first_name'].'",
				last_name = "'.$input['last_name'].'",
				nickname = "'.$input['nickname'].'"
				WHERE id = "'.$_SESSION['user_id'].'"';

		return mysql_query($sql);
	}

	public function updateUserPassword($input = array())
	{
		$sql = 'UPDATE users SET
				password = "'.md5($input['user_password']).'"
				WHERE id = "'.$_SESSION['user_id'].'"';

		return mysql_query($sql);
	}

	public function getAllProducts()
	{
		$sql = 'SELECT * FROM products order by id DESC';

		$query = mysql_query($sql);

		if($query)
		{
			$result = array();
			
			while($row = mysql_fetch_assoc($query))
			{
				$result[] = $row;
			}
			
			return $result;
		}
		
		return false;
	}

	public function createProduct($data)
	{
		$sql = 'INSERT INTO products (name, code, category, price, description, created_at)
				VALUES("'.$data['name'].'", "'.$data['code'].'", "'.$data['category'].'", "'.$data['price'].'", "'.$data['description'].'", "'.date('Y-m-d H:i:s').'" )';

		return mysql_query($sql);
	}

	public function getProductById($id = null)
	{
		if($id)
		{
			$sql = 'SELECT * FROM products WHERE id = "'.$id.'"';

			$query = mysql_query($sql);

			if($query)
			{
				return mysql_fetch_assoc($query);
			}
		}
		
		return false;
	}

	public function updateProduct($productId = null, $data)
	{
		$sql = 'UPDATE products SET
					name 		= "'.$data['name'].'",
					code 		= "'.$data['code'].'",
					category    = "'.$data['category'].'",
					price 		= "'.$data['price'].'",
					description = "'.$data['description'].'",
					updated_at  = "'.date('Y-m-d H:i:s').'"
				WHERE id = "'.$productId.'"';
		
		return mysql_query($sql);
	}

	public function getAllOffers()
	{
		$sql 	= 'SELECT * FROM offers order by id DESC';
		$query 	= mysql_query($sql);
	
		$result = array();
		
		while($row = mysql_fetch_assoc($query))
		{
			$result[] = $row;
		}
		
		return $result;
	}

	public function createOffer($data = array())
	{
		$userId 		= $data['user_id'];
		$startDate 		= $data['start_date'] ? date('Y-m-d', strtotime($data['start_date'])) : null;
		$endDate 		= $data['end_date'] ? date('Y-m-d', strtotime($data['end_date'])) : null;;
		$title 			= $data['title'];
		$description 	= $data['description'];
		$offerAll 		= $data['offer_all'];
		$offerValid 	= $data['offer_valid'];


		if($data['offer_valid'] == 1)
		{
			$startDate = '';
			$endDate   = '';
		}
		
		if($data['offer_all'] == 1)
		{
			$userId = 0;
			$sql = 'INSERT INTO offers (user_id, title, description, offer_all, offer_valid, start_date, end_date, created_at)
					VALUES(
						"'.$userId.'",
						"'.$title.'",
						"'.$description.'",
						"'.$offerAll.'",
						"'.$offerValid.'",
						"'.$startDate.'",
						"'.$endDate.'",
						"'. date('Y-m-d H:i:s') .'"
					)';
			return mysql_query($sql);
		}
		else
		{
			foreach ($data['user_id'] as $userId) 
			{
				$sql = 'INSERT INTO offers (user_id, title, description, offer_all, offer_valid, start_date, end_date, created_at)
						VALUES(
							"'.$userId.'",
							"'.$title.'",
							"'.$description.'",
							"'.$offerAll.'",
							"'.$offerValid.'",
							"'.$startDate.'",
							"'.$endDate.'",
							"'. date('Y-m-d H:i:s') .'"
						)';
				mysql_query($sql);
			}

			return true;
		}
	}

	public function removeOfferById($id = null)
	{
		if($id)
		{
			$sql = 'DELETE FROM offers WHERE id = "'.$id.'"';

			return mysql_query($sql);
		}

		return false;
	}

	public function insertBulkDealer($data = array())
	{
		$sql = 'INSERT INTO users (nickname, add1, add2, add3, city, tel, area, tinno, mobile, role)
				VALUES(
				"'.$data[0].'",
				"'.$data[1].'",
				"'.$data[2].'",
				"'.$data[3].'",
				"'.$data[4].'",
				"'.$data[5].'",
				"'.$data[6].'",
				"'.$data[7].'",
				"'.$data[8].'",
				3
			)';

		return mysql_query($sql);
	}

	public function createSalesExecutive($data = array())
	{
		if(is_array($data) && count($data))
		{
			$firstName 	= $data['first_name'];
			$lastName 	= $data['last_name'];
			$nickname 	= $data['first_name'] . " ".$data['first_name'];
			$emailId 	= $data['email_id'];
			$username 	= $data['username'];
			$password 	= md5($data['password']);
			$mobile 	= $data['mobile'];
			$add1 		= $data['add1'];
			$add2 		= $data['add2'];
			$city 		= $data['city'];
			$role 		= 2;

			$validationUsername = $this->validateByUsername($username);
			$validationEmailId = $this->validateByEmailid($emailId);
			$validationMobile = $this->validateByMobile($mobile);

			if($validationUsername == false || $validationEmailId == false || $validationMobile == false)
			{
				return false;
			}

			$sql = 'INSERT INTO users(first_name, last_name, nickname, email_id, username, password, mobile, add1, add2, city, role, status, created_at)
					VALUES(
						"'.$firstName.'",
						"'.$lastName.'",
						"'.$nickname.'",
						"'.$emailId.'",
						"'.$username.'",
						"'.$password.'",
						"'.$mobile.'",
						"'.$add1.'",
						"'.$add2.'",
						"'.$city.'",
						"'.$role.'",
						"1",
						"'.date('Y-m-d H:i:s').'"
					)';
			
			return mysql_query($sql);
		}

		return false;
	}

	public function validateByUsername($username='')
	{
		$sql = 'SELECT count(id) as count from users where username = "'.$username.'"';	

		$query = mysql_query($sql);

		$result = mysql_fetch_assoc($query);

		if($result['count'] > 0 )
		{
			return false;
		}

		return true;
	}

	public function validateByEmailid($emailId)
	{
		$sql = 'SELECT count(id) as count from users where email_id = "'.$emailId.'"';	

		$query = mysql_query($sql);

		$result = mysql_fetch_assoc($query);

		if($result['count'] > 0 )
		{
			return false;
		}

		return true;
	}

	public function validateByMobile($mobile)
	{
		$sql = 'SELECT count(id) as count from users where mobile = "'.$mobile.'"';	

		$query = mysql_query($sql);

		$result = mysql_fetch_assoc($query);

		if($result['count'] > 0 )
		{
			return false;
		}

		return true;
	}

	public function updateSalesExecutive($data = array())
	{
		if(is_array($data) && count($data) && isset($data['user_id']))
		{
			$userId = $data['user_id'];

			$sql = 'UPDATE users 
					SET
					first_name 	= "'.$data['first_name'].'",
					last_name 	= "'.$data['last_name'].'",
					nickname 	= "'.$data['first_name'] ." ". $data['last_name'].'",
					mobile 		= "'.$data['mobile'].'",
					add1 		= "'.$data['add1'].'",
					add2 		= "'.$data['add2'].'",
					city 		= "'.$data['city'].'"
					WHERE id = "'.$userId.'"';	

			return mysql_query($sql);
		}

		return false;
	}


	public function insertBulkProduct($data = array())
	{
		if(is_array($data) && count($data))
		{
			$sql = "INSERT INTO products (category, code, name, price, quantity, status, created_at)
					VALUES(
						'".$data[0]."',
						'".$data[1]."',
						'".$data[2]."',
						'".$data[3]."',
						'".$data[4]."',
						1,
						'".date('Y-m-d H:i:s')."'
					)";
			return mysql_query($sql);
		}

		return false;
	}
}

?>
