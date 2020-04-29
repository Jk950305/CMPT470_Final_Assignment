<?php
	session_start();
	include("connection.php"); 
	$isValid = False;
	if(isset($_POST["userName"]) && isset($_POST["userPassword"])){
		$name = $_POST["userName"];
		$password = $_POST["userPassword"];
		$md5_pw = md5($password);

		$sql = "SELECT EXISTS (
					SELECT *
					FROM users
					WHERE
						username = '{$name}' &&
						password = '{$md5_pw}'
					);";
		try{
			$result = $conn->query($sql);
			$row = $result->fetch();
			$isValid = $row[0]==1;
		}
		catch( \Exception $e){
			echo $e->getMessage();
		}
	}
	if($isValid){
		header("Location: ../landing.php");
		$_SESSION['loggedin'] = True;
	}else{
		header("Location: ../index.php");
		$_SESSION['loggedin'] = False;
	}
	exit();
?>