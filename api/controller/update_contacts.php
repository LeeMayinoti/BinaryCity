<?php
header("Access-Control-Allow-Origin:*");//Anybody can access!! 
header("Access-Control-Allow-Headers:access"); //
header("Access-Control-Allow-Method: POST");//Which method should they use if they want to access your API
header("Access-Control-Allow-Credetials:True");//if you don't have a username you don't access it.
header("Content-Type:Application/json");
 
 include_once '../Config/database.php';
 include_once '../data/data.php';
 //We are calling the database
 $database = new Database; //itialise the class
 $db = $database->getConnection(); //call the method
 $data = new data($db);


if(isset($_POST['email'])){
	$email = $_POST['email'];
	$data->email_address = $email;
 }

 if(isset($_POST['name'])){
	$fname = $_POST['name'];
	$data->first_name = $fname;
 }
 if(isset($_POST['sname'])){
	$sname = $_POST['sname'];
	$data->last_name = $sname;
 }
 if(isset($_POST['client_id'])){
	$client_id = $_POST['client_id'];
	$data->client_id = $client_id;
 }
 if(isset($_POST['id'])){
	$id = $_POST['id'];
	$data->contact_id = $id;
 }
 
					
  $RegisterCandidate = $data->updateContacts();
  

 if($RegisterCandidate !=0)
 {
	 switch($RegisterCandidate)
	 {
		 case 1:
			http_response_code(200);
			echo json_encode(array("message" => "Hi ". $data->first_name .", Contact has been successfully updated"));	
		 break;
		 case -1:
			http_response_code(201);
			echo json_encode(array("message" => "Hi ". $data->first_name .", Contact Was Not updated"));	
		 break;
		 case -2:
			http_response_code(202);
			echo json_encode(array("message" => "Hi ". $data->first_name .", Sorry this account exist already "));	
		 break;
	 }	
 }else{
	http_response_code(404);
	echo json_encode(array("message" => "$RegisterCandidate Sorry, The system could not process your request.")); 
 }
 

 ?>