<?php
require_once('includes/master.class.php');
$object = new Master;

$status = $object->validateSession();

if(isset($_FILES))
{
	$type 		= $_POST['uploadtype'];
	$category 	= $_POST['category'];
	$title 		= $_POST['image_content_post_title'];
	$uploadPath = 'media' . DIRECTORY_SEPARATOR . $_SESSION['user_id'] . DIRECTORY_SEPARATOR;
	$object->checkOrMakeDir($uploadPath);

	$fileName = rand(0000, 1111).'_'.$_FILES['file']['name'][0];
	$targetFile = $uploadPath.$fileName;
	
	if(move_uploaded_file($_FILES['file']['tmp_name'][0], $targetFile))
	{
		$data = array(
			'category' 		=> $category ? $category : 'image',
			'title'   		=> $title,
			'media_name' 	=> $fileName
		);

		$status = $object->createMedia($data);
		if($status)
		{
			echo json_encode(array(
				'status' => true
			));
			die;
		}
	}
}

echo json_encode(array(
	'status' => false
));
die;
?>