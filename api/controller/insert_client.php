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




 if(isset($_POST['name'])){
	$client_name = $_POST['name'];
	$data->Client_name = $client_name;
	// converting the name into capital laters using pregmatch all to find every occurence of space
	$name = explode(" ", $client_name);
	// if they have a long name e.g FIRST NAtional bank
	
    if (sizeof($name) > 1 ){
		$expr = '/(?<=\s|^)[a-z]/i';
		preg_match_all($expr, $client_name, $matches);
		$result = implode('', $matches[0]);
		$data->ClientCode = strtoupper($result);
   }else if (sizeof($name) == 1 && strlen($name[0]) >= 3 ){
     //take the first 3 letters of the word 
	 $result = substr($name[0], 0, 3);
	
	 $data->ClientCode = strtoupper($result);
   }else if(sizeof($name) == 1 && strlen($name[0]) < 3){
	   //calulate the number of required alphabet letters to put in the name
	  $word = substr(str_shuffle("abcdefghijklmnopqrstvwxyz"), 0, 3- strlen($name[0]));
	  $result = $name[0].$word;
	  $data->ClientCode = strtoupper($result);
   }

 }

 
					
  $RegisterCandidate = $data->insertClients();
  

 if($RegisterCandidate !=0)
 {
	 switch($RegisterCandidate)
	 {
		 case 1:
			http_response_code(200);
			echo json_encode(array("message" => "Hi ". $data->Client_name .", Contact has been successfully created"));	
		 break;
		 case -1:
			http_response_code(201);
			echo json_encode(array("message" => "Hi ". $data->Client_name .", Contact Was Not Created"));	
		 break;
		 case -2:
			http_response_code(202);
			echo json_encode(array("message" => "Hi ". $data->Client_name .", Sorry this account exist already "));	
		 break;
	 }	
 }else{
	http_response_code(404);
	echo json_encode(array("message" => "$RegisterCandidate Sorry, The system could not process your request.")); 
 }
 

 ?>