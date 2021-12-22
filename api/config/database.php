<?php

class Database{
	private $host = "localhost";
	private $db_name = "bcity";
	private $username = "root";
	private $password = "";
	public $connect;
	
	
	public function getConnection(){
		// clearing the data 

		$this->connect = null;
		
		try{
            $this->connect = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->connect->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
		return $this->connect;
	}
	
}

?>