<?php
if(isset($_GET['filePath']))
{
	//$filePath = 'http://'. $_SERVER['HTTP_HOST']. DIRECTORY_SEPARATOR .'app'.DIRECTORY_SEPARATOR.$_GET['filePath'];
	//
	$fileExtension = explode(".", $_GET['filePath']);
	$fileExtension = array_pop($fileExtension);
	$filePath = __DIR__.DIRECTORY_SEPARATOR.$_GET['filePath'];;

	if(file_exists($filePath))
	{
	    // Define headers
	    header("Cache-Control: public");
	    header("Content-Description: File Transfer");
	    header("Content-Disposition: attachment; filename=media.".$fileExtension);
	    header("Content-Type: application/zip");
	    header("Content-Transfer-Encoding: binary");
	    
	    // Read the file
	    readfile($filePath);
	    exit;
	}else{
	    echo 'The file does not exist.';
	}
}

?>