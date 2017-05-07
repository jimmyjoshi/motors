<?php
require_once('includes/master.class.php');

$object = new Master;

$object->validateSession();
$object->clearSession();

session_destroy();
header("location:index.php");

?>
