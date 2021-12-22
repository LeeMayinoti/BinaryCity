<?php
header("Access-Control-Allow-Origin:*");//Anybody can access!!
 header("Access-Control-Allow-Headers:access"); //
 header("Access-Control-Allow-Method: POST");//Which method should they use if they want to access your API
 header("Access-Control-Allow-Credetials:True");//if you don't have a username you don't access it.
 header("Content-Type:Application/json");
 
 include_once '../config/database.php';
 include_once '../data/data.php';
 //We are calling the database
 $database = new Database; //itialise the class
 $db = $database->getConnection(); //call the method
 $data = new Data($db);
 	$jsonStr = file_get_contents("php://input"); //read the HTTP body.
	$json = json_decode($jsonStr, true);
 
if(isset($json['tables'])){
	$table = @ $json['tables'];
	$data->tables =  $table;
 }
 if(isset($json['extra'])){
	$table = @ $json['extra'];
	$data->delete_extra =  $table;
 }

 if(isset($json['condition'])){
	$condition = @ $json['condition'];
	$data->condition =  $condition;
 }
 
  $delete = $data->delete_table();
  
  
  if($delete >0)
		 { 
		    
			http_response_code(200);
			echo json_encode(array("message" =>"deleted  successfully"));	
         }else
		 {
			 http_response_code(201);
			 echo json_encode(array("message" => "failed to  delete  "));	
		 }