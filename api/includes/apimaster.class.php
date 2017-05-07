<?php

class API
{
	protected $host = "localhost";
	
	protected $username = "mmotors";
	
	protected $password = "Admin@123";
	
	protected $db = "mmotors";
	
	public $headOfficeId;
	
	public function __construct()
	{
		$connection = mysql_connect($this->host, $this->username, $this->password);
		
		mysql_select_db($this->db, $connection);
		
		
		$this->headOfficeId = 1;
	}

	public function setResponse($response = array(), $message = '', $status = false)
	{
		if($status)
		{
			echo json_encode(array(
				'data' 		=> $response,
				'message' 	=> $message,
				'status'	=> '200',
				'success'	=> true
			));
			exit;
		}

		if(!is_array($response))
		{
			$response = [];	
		}

		echo json_encode(array(
				'data' 		=> $response,
				'message' 	=> $message,
				'status'	=> '404',
				'success'	=> false
			));
			exit;
	}
	

	public function login($username, $password)
	{
		$sql = 'SELECT * FROM users WHERE password="'. md5($password).'"  AND username = "'.$username.'"';

		$result = mysql_query($sql);

		if($result)
		{
			return mysql_fetch_assoc($result);
		}

		return false;
	}
	
	public function validateUserByUserName($username = '')
	{
		if($username)
		{
		
			$sql = 'SELECT count(id) usercount from users where username = "'.$username.'"';	
			
			$result = mysql_query($sql);
			
			if($result)
			{
				return mysql_fetch_assoc($result);
			}
		}
	}
	
	public function validateUserByEmailId($emailId = '')
	{
		if($emailId )
		{
		
			$sql = 'SELECT count(id) usercount from users where email_id = "'.$emailId .'"';	
			
			$result = mysql_query($sql);
			
			if($result)
			{
				return mysql_fetch_assoc($result);
			}
		}
	}
	
	
	public function createDealer($data = array(), $files = array())
	{
		if(is_array($data) && count($data))
		{
			$validateUsername = $this->validateUserByUserName($data['username']);
			$validateEmailId = $this->validateUserByUserName($data['email_id']);
			
			if($validateUsername['usercount'] > 0 || $validateEmailId['usercount'] > 0)
			{
				return false;
			}
			
			$firstName = $data['first_name'] ? $data['first_name'] : '';
			$lastName  = $data['last_name'] ? $data['last_name'] : '';
			$nickname  = $firstName. " ".$lastName;
			$username  = $data['username'];
			$emailId   = $data['email_id'];
			$password  = md5($data['password']);
			$mobile    = $data['mobile'] ? $data['mobile']  : '';
			$add1    = $data['add1'] ? $data['add1']  : '';
			$add2    = $data['add2'] ? $data['add2']  : '';
			$add3    = $data['add3'] ? $data['add3']  : '';
			$city    = $data['city'] ? $data['city']  : '';
			$tel     = $data['tel'] ? $data['tel']  : '';
			$area    = $data['area'] ? $data['area']  : '';
			$tinno   = $data['tinno'] ? $data['tinno']  : '';
			$role 	 = 3;
			$status  = 1;
			$created = date('Y-m-d H:i:s');
			$profilePic = "default.png";
			
			$sql = 'INSERT INTO users (first_name, last_name, nickname, username, email_id, password, 
				mobile, add1, add2, add3, city, tel, area, tinno, role, status, profile_pic,created_at)
				VALUES(
					"'.$firstName.'",
					"'.$lastName.'",
					"'.$nickname.'",
					"'.$username.'",
					"'.$emailId.'",
					"'.$password.'",
					"'.$mobile.'",
					"'.$add1.'",
					"'.$add2.'",
					"'.$add3.'",
					"'.$city.'",
					"'.$tel.'",
					"'.$area.'",
					"'.$tinno.'",
					"'.$role.'",
					"'.$status.'",
					"'.$profilePic.'",
					"'.$created .'"
				)';	
			return 	mysql_query($sql);
		}
		
		return false;
	}
	
	public function getApiProducts()
	{
		$sql = 'SELECT * FROM products order by id DESC';
		
		$query = mysql_query($sql);
		
		$response = [];
		
		while($row = mysql_fetch_assoc($query))
		{
			$response[] = [
				'name' 		=> $row['name'],
				'code' 		=> $row['code'],
				'category' 	=> $row['category'],
				'price' 	=> $row['price'],
				'description' 	=> $row['description'],
				'created_at' 	=> isset($row['created_at']) ?  $row['created_at'] : ''
			];
		}
		
		return $response;
	}
	
	public function getApiDealers()
	{
		$sql = 'SELECT * FROM users WHERE status = 1 AND role = 3 order by id DESC';
		
		$query = mysql_query($sql);
		
		$response = [];
		
		while($row = mysql_fetch_assoc($query))
		{
			$picName = strlen($row['profile_pic']) > 2 ? $row['profile_pic'] : 'default.png';

			$profilePic = 'http://' . $_SERVER['HTTP_HOST'] . '/api/uploads/'. $picName;
			$response[] = [
				'first_name' 		=> $row['first_name'],
				'last_name' 		=> $row['last_name'],
				'nickname' 		=> $row['nickname'],
				'email_id' 		=> $row['email_id'],
				'mobile' 		=> $row['mobile'],
				'add1' 			=> $row['add1'],
				'add2' 			=> $row['add2'],
				'add3' 			=> $row['add3'],
				'city' 			=> $row['city'],
				'tel' 			=> $row['tel'],
				'area'			=> $row['area'],
				'tinno' 		=> $row['tinno'],
				'profile_picture'	=> $profilePic,
				'created_at' 		=> isset($row['created_at']) ?  $row['created_at'] : ''
			];
		}
		
		return $response;
	}

	public function getApiSalesExecutives()
	{
		$sql = 'SELECT * FROM users WHERE status = 1 AND role = 2 order by id DESC';
		
		$query = mysql_query($sql);
		
		$response = [];
		
		while($row = mysql_fetch_assoc($query))
		{
			$picName = strlen($row['profile_pic']) > 2 ? $row['profile_pic'] : 'default.png';

			$profilePic = 'http://' . $_SERVER['HTTP_HOST'] . '/api/uploads/'. $picName;
			$response[] = [
				'first_name' 		=> $row['first_name'],
				'last_name' 		=> $row['last_name'],
				'nickname' 		=> $row['nickname'],
				'email_id' 		=> $row['email_id'],
				'mobile' 		=> $row['mobile'],
				'add1' 			=> $row['add1'],
				'add2' 			=> $row['add2'],
				'add3' 			=> $row['add3'],
				'city' 			=> $row['city'],
				'tel' 			=> $row['tel'],
				'area'			=> $row['area'],
				'tinno' 		=> $row['tinno'],
				'profile_picture'	=> $profilePic,
				'created_at' 		=> isset($row['created_at']) ?  $row['created_at'] : ''
			];
		}
		
		return $response;		
	}

	public function getApiOffers($userId = null)
	{
		if($userId)
		{
			$sql = 'SELECT * FROM offers WHERE user_id = "'.$userId.'" OR offer_all = 1 order by id DESC';
			
			
			$query = mysql_query($sql);
			
			$response = [];
			
			while($row = mysql_fetch_assoc($query))
			{
				$currentStatus = "in-active";

				if($row['offer_valid'] == 1)
				{
					$currentStatus = "active";					
				}
				else
				{
					if(strtotime($row['start_date']) <= time() && time() <= strtotime($row['end_date']))
					{
						$currentStatus = "active";		
					}
				}

				$response[] = [
					'title' 			=> $row['title'],
					'description' 		=> $row['description'],
					'offer_valid' 		=> $row['offer_valid'],
					'start_date' 		=> $row['start_date'],
					'end_date' 			=> $row['end_date'],
					'currentStatus'		=> $currentStatus,
					'created_at' 		=> isset($row['created_at']) ?  $row['created_at'] : ''
				];
			}
			
			return $response;	
		}

		return false;
	}

	public function createOrder($data = array())
	{
		if(is_array($data) && count($data))
		{

			$userId 	= $data['user_id'];
			$salesId 	= (isset($data['sales_id']) && $data['sales_id'] != '') ? $data['sales_id'] : 0 ;
			$title 		= isset($data['title']) ? $data['title'] : '';
			$subtotal	= isset($data['subtotal']) ? $data['subtotal'] : '';
			$tax		= isset($data['tax']) ? $data['tax'] : '';
			$discount	= isset($data['discount']) ? $data['discount'] : '';
			$total		= isset($data['total']) ? $data['total'] : '';
			$due		= isset($data['due']) ? $data['due'] : '';
			$paid		= isset($data['paid']) ? $data['paid'] : '';		
			$notes		= isset($data['notes']) ? $data['notes'] : '';
			$transporter = isset($data['transporter']) ? $data['transporter'] : '';
			$orderDate 	= date('Y-m-d');
			$orderMonth = date('F');
			$createdBy  = ( isset($data['sales_id']) && $data['sales_id'] != '' && $data['sales_id'] != 0 ) ? $data['sales_id'] : $data['user_id'];
			$createdAt  = date('Y-m-d H:i:s');
			$products 	= $data['products'];

			$sql = 'INSERT INTO orders (user_id, sales_id, title, subtotal, tax, discount, total, due, paid, orderdate, month, notes, transporter, created_by, created_at)
					VALUES (
						"'.$userId.'",
						"'.$salesId.'",
						"'.$title.'",
						"'.$subtotal.'",
						"'.$tax.'",
						"'.$discount.'",
						"'.$total.'",
						"'.$due.'",
						"'.$paid.'",
						"'.$orderDate.'",
						"'.$orderMonth.'",
						"'.$notes.'",
						"'.$transporter.'",
						"'.$createdBy.'",
						"'.$createdAt.'"
					)';

			$orderStatus = mysql_query($sql);

			if($orderStatus)
			{
				$orderId = mysql_insert_id();
				$products = json_decode($products, true);	
				

				foreach($products as $product)
				{
					$sql = 'INSERT INTO order_details (order_id, product_id, qty, rate, subtotal, created_at)
							VALUES(
								"'.$orderId.'",
								"'.$product['id'].'",
								"'.$product['qty'].'",
								"'.$product['rate'].'",
								"'.$product['subtotal'].'",
								"'.date('Y-m-d H:i:s').'"
							)';
					
					mysql_query($sql);
				}
			}
		return true;
		}

		return false;
	}

	public function getOrderProducts($orderId = null)
	{
		$response = [];

		if($orderId)
		{
			$sql = 'SELECT order_details.*,products.name,products.code,products.category,products.code
					FROM order_details
					LEFT JOIN products on products.id = order_details.product_id
					WHERE order_id ="'.$orderId.'"
					order by order_details.id ';

			$query = mysql_query($sql);

			$sr = 0;
			while($row = mysql_fetch_assoc($query))
			{
				$response[$sr] = array(
					'product_id' 	=> $row['product_id'],
					'product_name' 	=> $row['name'],
					'category' 		=> $row['category'],
					'code' 			=> $row['code'],
					'qty' 			=> $row['qty'],
					'rate' 			=> $row['rate'],
					'subtotal' 		=> $row['subtotal']
				);

				$sr++;
			}

			return $response;
		}

		return $response;
	}
	
	public function getAPIOrdersByUserId($userId = null)
	{
		if($userId)
		{
			$sql 		= 'SELECT * FROM orders WHERE user_id ="'.$userId.'"';
			$query 		= mysql_query($sql);
			$response 	= [];
			
			while($row = mysql_fetch_assoc($query))
			{
				$response[] = array(
					'order_id'	=> $row['id'],
					'title'		=> isset($row['title']) ? $row['title'] : '',
					'subtotal'	=> isset($row['subtotal']) ? $row['subtotal'] : '',
					'tax'		=> isset($row['tax']) ? $row['tax'] : '',
					'discount'	=> isset($row['discount']) ? $row['discount'] : '',
					'total'		=> isset($row['total']) ? $row['total'] : '',
					'due'		=> isset($row['due']) ? $row['due'] : '',
					'paid'		=> isset($row['paid']) ? $row['paid'] : '',
					'orderdate'	=> isset($row['orderdate']) ? $row['orderdate'] : '',
					'month'		=> $row['month'],
					'notes'		=> isset($row['notes']) ? $row['notes'] : '',
					'status'	=> $row['order_status'],
					'transporter'	=> isset($row['transporter']) ? $row['transporter'] : '',
					'lr_number'	=> isset($row['lr_number']) ? $row['lr_number'] : '',
					'products'	=> $this->getOrderProducts($row['id']),
					'salesInfo'	=> $this->getSalesUserInfoById($row['sales_id'])
				);


				$sr++;
			}

			return $response;
		}

		return $response;
	}

	public function flushToken($userId = null)
	{
		if($userId)
		{
			$sql = 'DELETE FROM active_users WHERE user_id = "'.$userId.'"';

			return mysql_query($sql);
		}
		return false;
	}

	public function setToken($userId = null, $token = null)
	{
		if($userId && $token)
		{
			$flushToken = $this->flushToken($userId);
			
			$sql = 'INSERT INTO active_users(user_id, cgm_token, created_at)
					VALUES(
						"'.$userId.'",
						"'.$token.'",
						"'.date('Y-m-d H:i:s').'"
					)';
			return mysql_query($sql);
		}

		return false;
	}
	
	public function sendMessage($data = array())
	{
		if(is_array($data) && count($data))
		{
			$sql = 'INSERT INTO messages (msg_from, msg_to, content, created_at)
				VALUES(
					"'.$data['msg_from'].'",
					"'.$this->headOfficeId.'",
					"'.$data['content'].'",
					"'.date('Y-m-d H:i:s').'"
				)';
				
			return mysql_query($sql);
		}
		
		return false;
	}
	
	public function getAPIMessagesByUserId($userId = null)
	{
		if($userId)
		{
			$sql = 'SELECT messages.*,users.nickname FROM messages 
				LEFT JOIN users on users.id = messages.msg_from
				WHERE msg_to = "'.$userId.'" OR is_broadcast = 1
				order by messages.id desc';
			
			$query = mysql_query($sql);
			$response = [];
			
			while($row = mysql_fetch_assoc($query))
			{
				$response[] = array(
					'from_name' 	=> $row['nickname'],
					'content'   	=> $row['content'],
					'is_broadcast' 	=> $row['is_broadcast'],
					'created_at'	=> $row['created_at']
				);
			
			}
			
			return $response;
		}
		
		return $response;
	}
	
	public function getAPISentBoxByUserId($userId = null)
	{
		if($userId)
		{
			$sql = 'SELECT messages.*,users.nickname FROM messages 
				LEFT JOIN users on users.id = messages.msg_to
				WHERE msg_from = "'.$userId.'" 
				order by messages.id desc';
			
			$query = mysql_query($sql);
			$response = [];
			
			while($row = mysql_fetch_assoc($query))
			{
				$response[] = array(
					'to_name' 	=> $row['nickname'],
					'content'   	=> $row['content'],
					'is_broadcast' 	=> $row['is_broadcast'],
					'created_at'	=> $row['created_at']
				);
			
			}
			
			return $response;
		}
		
		return $response;
	}
	
	public function getDealerInfoById($userId = null)
	{

		$response = [];
		
		
		if($userId)
		{
			$sql = 'SELECT * from users WHERE id = "'.$userId.'"';
			
			$query = mysql_query($sql);
			
			
			$userInfo = (object) mysql_fetch_assoc($query);
			
			if($userInfo)
			{
				
				
				$response = [
					'user_id' 			=> $userInfo->id,
					'first_name' 			=> $userInfo->first_name,
					'last_name'	 		=> $userInfo->last_name,
					'email_id' 			=> $userInfo->email_id,
					'mobile' 			=> $userInfo->mobile,
					'add1' 				=> $userInfo->add1,
					'add2' 				=> $userInfo->add2,
					'add3' 				=> $userInfo->add3,
					'city' 				=> $userInfo->city,
					'telephone' 			=> $userInfo->tel,
					'area' 				=> $userInfo->area,
					'tinno' 			=> $userInfo->tinno,
					'status' 			=> $userInfo->status,
					'role'				=> $userInfo->role,
					'profile_picture' 		=> 'http://'.$_SERVER['HTTP_HOST'] .'/api/uploads/'.$userInfo->profile_picture,
					'created_at'			=> $userInfo->created_at
				];
			}

		}
		
		return $response;
	}
	
	public function getSalesUserInfoById($userId = null)
	{

		$response = [];
		
		
		if($userId)
		{
			$sql = 'SELECT * from users WHERE id = "'.$userId.'"';
			
			$query = mysql_query($sql);
			
			
			$userInfo = (object) mysql_fetch_assoc($query);
			
			if($userInfo)
			{
				
				
				$response = [
					'user_id' 			=> $userInfo->id,
					'first_name' 			=> $userInfo->first_name,
					'last_name'	 		=> $userInfo->last_name,
					'email_id' 			=> $userInfo->email_id,
					'mobile' 			=> $userInfo->mobile,
					'add1' 				=> $userInfo->add1,
					'add2' 				=> $userInfo->add2,
					'add3' 				=> $userInfo->add3,
					'city' 				=> $userInfo->city,
					'telephone' 			=> $userInfo->tel,
					'area' 				=> $userInfo->area,
					'tinno' 			=> $userInfo->tinno,
					'status' 			=> $userInfo->status,
					'role'				=> $userInfo->role,
					'profile_picture' 		=> 'http://'.$_SERVER['HTTP_HOST'] .'/api/uploads/'.$userInfo->profile_picture,
					'created_at'			=> $userInfo->created_at
				];
			}

		}
		
		return $response;
	}
	
	public function getAPIOrdersBySalesId($userId = null)
	{
		$response 	= [];
		if($userId)
		{
			$sql 		= 'SELECT * FROM orders WHERE sales_id ="'.$userId.'"';
			$query 		= mysql_query($sql);
			
			while($row = mysql_fetch_assoc($query))
			{
				$response[] = array(
					'order_id'	=> $row['id'],
					'title'		=> isset($row['title']) ? $row['title'] : '',
					'subtotal'	=> isset($row['subtotal']) ? $row['subtotal'] : '',
					'tax'		=> isset($row['tax']) ? $row['tax'] : '',
					'discount'	=> isset($row['discount']) ? $row['discount'] : '',
					'total'		=> isset($row['total']) ? $row['total'] : '',
					'due'		=> isset($row['due']) ? $row['due'] : '',
					'paid'		=> isset($row['paid']) ? $row['paid'] : '',
					'orderdate'	=> isset($row['orderdate']) ? $row['orderdate'] : '',
					'month'		=> $row['month'],
					'notes'		=> isset($row['notes']) ? $row['notes'] : '',
					'status'	=> $row['order_status'],
					'transporter'	=> isset($row['transporter']) ? $row['transporter'] : '',
					'lr_number'	=> isset($row['lr_number']) ? $row['lr_number'] : '',
					'products'	=> $this->getOrderProducts($row['id']),
					'dealerInfo'	=> $this->getDealerInfoById($row['user_id'])
				);
				
				$sr++;
			}

		}	
		return $response;
	}
	
}