<?php
// error_reporting(E_ALL);
class Mysql{
	private $host;
	private $username;
	private $password;
	private $dbname;
	private $con;

	function Mysql(){
		$this->host = "localhost";
		$this->username = "root";
		$this->password = "";
		$this->dbname = "flora";
	}
	
	function connect(){	
		$this->con = new mysqli(
			$this->host, $this->username, $this->password, $this->dbname);
		// Check connection status
		if ($this->con->connect_error) {
		  die("Connection failed: " . $this->con->connect_error);
		}

		mysqli_set_charset($this->con, 'utf8');
		mysqli_query($this->con, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
		mysqli_query($this->con, "SET CHARACTER SET 'utf8'");
		echo "<p class='success'>Data Base was connected successfully</p>";
	}
	function close(){
		$this->con->close();
	}

	// insert users to mysql table
	function insertUser($login, $password, $email, $fio){
		$sql = "INSERT INTO `users`
				(`login`, `password`, `email`, `fio`, `role`)
				VALUES (?, ?, ?, ?, 'regular');";
		$stmt = $this->con->prepare($sql);
		$stmt->bind_param("ssss", $login,
			$password, $email, $fio);
		if($stmt->execute() != TRUE){
			die("Error: " . $sql . "<br>" . $this->con->error);
		}

		return true;
	}
	// authorization
	function authorization($login, $password){
		$sql = "SELECT * FROM `users` WHERE 
				(`login`= ? AND `password`= ? ) LIMIT 1";
		$stmt = $this->con->prepare($sql);
		$stmt->bind_param("ss", $login, $password);
		if($stmt->execute() != TRUE){
			die("Error: " . $sql . "<br>" . $this->con->error);
		}
		$result = $stmt->get_result();
		
		return $result;
	}
}
?>