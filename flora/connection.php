<?php 
	define("host_db","localhost");
	define("user_db","root");
	define("pass_db","");
	define("name_db","flora");

	$connect = mysqli_connect(host_db, user_db, pass_db, name_db) or die("No connection!");
	mysqli_set_charset($connect, "utf8") or die("No charset!");
	/*
	function open_con()
	{
		$conn = mysqli_connect($host, $user, $pass, $bd);
		if (!$conn) die("Failed: " . mysqli_connect_error());
		//mysqli_set_charset($conn, 'utf8');

		return $conn;
	}

	try{
    $pdo = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e){
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
	}

	function close_con($conn)
	{
		$conn -> close();
	}

	//session_start();
	*/
?>