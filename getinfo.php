<?php
error_reporting(E_ALL);
ini_set('display_errors','On');
	
require_once("data.php");

$id = $_GET['id'];
$data = new propertyData();

if (is_object($data)) $status = '200 OK';
$status_header = "HTTP/1.1 $status";

header($status_header);
echo json_encode( $data->getAll($id) );


?>