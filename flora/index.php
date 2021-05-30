<?php
	session_start();
	// remember session id for 1 hour
	session_set_cookie_params(60*60*2); 

	header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>

<?
	$is_authorized = false;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// init
		require "mysql.php";
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		// connect
		$mysql = new Mysql();
		$mysql->connect();

		// vallidation and mysql request
		if(preg_match("/[0-9a-z]{1,100}/i", $login) && preg_match("/[0-9a-z]{4,100}/i", $password)){
			$result = $mysql->authorization($login, $password);
			if($result->num_rows > 0){
				$result = $result->fetch_assoc();

				$_SESSION['login']=$result['login'];
				$_SESSION['email']=$result['email'];
				$_SESSION['fio']=$result['fio'];
				$_SESSION['role']=$result['role'];

				$is_authorized = true;
			}
			else{
				echo "<p class='failure'>This user doesn't exist</p>";
			}
		}
		else{
			echo "<p class='failure'>We cannot validate this data</p>";
		}

		$mysql->close();
	}

	if($is_authorized!=null || isset($_SESSION['fio'])){
		echo '
			<script type="text/javascript">
	        	window.location = "flores.php"
	      	</script>';
	}
	?>

	<form action="index.php" method="POST">
		<h3>Sign in</h3>
		<p>Login</p>
		<input type="text" name="login">
		<p>Password</p>
		<input type="password" name="password">
		<input type="submit">
	</form>
	<a href="registration.php">Sign up</a>


	</body>
	<style type="text/css">
		*{
			font-family: 'sans-serif', arial;
			font-size: 1em;
			text-align: center;
		}
		table{
			margin: 10px auto;
			border-collapse: collapse;
		}
		table tr:first-child{
			background: #1976d2;
		}
		table tr:first-child td{
			border-right: 1px solid #ddd;
		}
		table tr:first-child td:last-child{
			border-right: 1px solid #1976d2;
		}
		td{
			padding: 10px;
			border: 1px solid #1976d2;

			text-align: left;
		}
		input[type="text"],
		input[type="password"]{
			margin-bottom: 10px;
			padding: 5px;
			width: 100%;
		}
		input[type="submit"]{
			display: block;
			margin: 25px auto;
			padding: 10px;
			background-color: white;
			border: 1px solid #333;
			cursor: pointer;

			transition: all 0.2s ease-in-out;
		}
		input[type="submit"]:hover{
			background-color: #333;
			color: white;
		}
		form{
			margin: 0 auto;
			margin-bottom: 25px;
			padding: 0 50px;
			width: 300px;
			/*border: 1px solid #1976d2;*/
			box-sizing: border-box;
		}
		form *{
			text-align: left;
		}
		h3{
			font-size: 1.2em;
		}
		.success{
			color: #388e3c;
		}
		.failure{
			color: #B00020;
		}
		a{
			text-decoration: none;
		}
	</style>
</html>