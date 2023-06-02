<?php

require_once "config.php";

class DbHelper
{
	/*	
	private $host = DB_HOST;
	private $username = DB_USER;
	private $password = DB_PASS;
	private $db_name = DB_NAME;
*/
//DB_HOST=127.0.0.1
//DB_PORT=3306
private $host = "127.0.0.1";
private $username = "root";
private $password = "bangkok1234";
private $db_name = "immigration";

	public $conn; // connect db

	public function Connect()
	{
			$this->conn=null;
			
			try{
				$this->conn=new PDO("mysql:host=127.0.0.1;dbname=immigration;port=3306","root", "bangkok1234" );
				//$this->conn=new PDO("mysql:host=". $this->host . ";dbname=" . $this->db_name, $this->username, $this->password );
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->conn->exec("set names utf8");				

			}
			catch(PDOException $ex)
			{
				echo "Connection Error:" .$ex->getMessage();
			}
			
			//return $this->conn;
	}
	
	public function Prepare($sql){
		return $this->conn->prepare($sql);	
	}
	
	public function Execute(){
		$this->conn->execute();
	}
	
	
	public function BeginTran(){
		$this->conn->beginTransaction();
	}

	public function Commit(){
		$this->conn->commit();
	}
	
	public function Rollback(){
		$this->conn->rollback(); 
	}
	
}



?>