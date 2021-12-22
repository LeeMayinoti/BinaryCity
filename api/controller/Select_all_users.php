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



    $member_array = array();
	$memberInfo = $data->selectAllContacts();
	$nums = $memberInfo->rowCount();
	if($nums>0){
		while ($row = $memberInfo->fetch(PDO::FETCH_ASSOC))
		{
			array_push($member_array,$row);
		}
		if(is_array($member_array)>0){
			http_response_code(200);
			echo json_encode($member_array);	
		}else{
			echo json_encode(array("message"=> "No data found"));
		}
	}
	
	
?>
 