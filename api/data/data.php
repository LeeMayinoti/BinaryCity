<?php
class Data{
	private $connect;

	public $first_name;
	public $last_name;

	public $sex;
	public $ClientCode;
	public $email_address;
	public $Client_name;
	public $contact_id;
	
	public $client_id;

	
	Public function __construct($db)
	{
		$this->connect = $db;
		
	}

	
	Public function insertContacts()
	{

				$query = "INSERT INTO `contacts` (`Name`,`Surname`,`email`,`clientID`) ";
				$query .= "VALUES (:Name , :Surname ,:email  , :clientID )";

				$stmt = $this->connect->prepare($query);
		
				$stmt->bindParam(':Name', $this->first_name);
                $stmt->bindParam(':Surname', $this->last_name);
                $stmt->bindParam(':email', $this->email_address);
                $stmt->bindParam(':clientID', $this->client_id);

				$stmt->execute();
	   
				if($this->connect->lastInsertId()>0)
				{
						$success=1;
			    }else{
						$success=-1;
				}
	

		return $success;
	}

	Public function insertClients()
	{

				$query = "INSERT INTO `clients` (`Client_name`,`ClientCode`) ";
				$query .= "VALUES (:Client_name , :ClientCode )";

				$stmt = $this->connect->prepare($query);
				
		
				$stmt->bindParam(':Client_name', $this->Client_name);
                $stmt->bindParam(':ClientCode', $this->ClientCode);


				$stmt->execute();
	   
				if($this->connect->lastInsertId()>0)
				{
					$this->ClientCode = $this->ClientCode.str_pad($this->connect->lastInsertId(), 3, '0', STR_PAD_LEFT);

					$query = "UPDATE  `clients` SET `ClientCode`= '".$this->ClientCode ."'" ."WHERE id=".$this->connect->lastInsertId();
					$stmt = $this->connect->prepare($query);
					$stmt->execute();

						$success=1;
			    }else{
						$success=-1;
				}
	

		return $success;
	}

	
	Public function updateContacts()
	{

				$query = "UPDATE  `contacts` SET  `Name` = :Name,`Surname` = :Surname,`email` =:email,`clientID` = :clientID WHERE id = :id";
				$stmt = $this->connect->prepare($query);
		
				$stmt->bindParam(':Name', $this->first_name);
                $stmt->bindParam(':Surname', $this->last_name);
                $stmt->bindParam(':email', $this->email_address);
                $stmt->bindParam(':clientID', $this->client_id);
                $stmt->bindParam(':id', $this->contact_id);

				$stmt->execute();
	   
				if($this->connect->lastInsertId()>0)
				{
						$success=1;
			    }else{
						$success=-1;
				}
	

		return $success;
	}

public function selectAllContacts(){
		$query="SELECT `contacts`.* ,`clients`.`Client_name`,`clients`.`ClientCode` FROM contacts INNER JOIN clients ON `contacts`.clientID = `clients`.id;";
		$stmt = $this->connect->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	
	
public function selectAllClients(){
	$query="SELECT cl.*,(SELECT COUNT(contacts.clientID) FROM  contacts WHERE contacts.clientID = cl.id ) AS total_contacts FROM clients cl";
	$stmt = $this->connect->prepare($query);
	$stmt->execute();
	return $stmt;
}

public function selectContactById($id){
	$query="SELECT *  FROM `contacts` WHERE id=$id";
	$stmt = $this->connect->prepare($query);
	$stmt->execute();
	return $stmt;
}

}

?>
