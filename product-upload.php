<?php
require_once('includes/master.class.php');
$object = new Master;

$status = $object->validateSession();
/*echo "Disable Bulk UPload";
die;*/
//open uploaded csv file with read only mode
$csvFile = fopen('files/products.csv', 'r');
            
    fgetcsv($csvFile);
        
     echo "<pre>";
     $success = $failure = 0;
    //parse data from csv file line by line
    while(($line = fgetcsv($csvFile)) !== FALSE)
    {
    	$status  =$object->insertBulkProduct($line);

    	if($status)
    	{
    		$success++;
    	}
    	else
    	{
    		$failure++;
    	}
    }
fclose($csvFile);

echo "Success : <strong>". $success . '</strong><br>';
echo "Failure : <strong>". $failure . '</strong><br>';
?>