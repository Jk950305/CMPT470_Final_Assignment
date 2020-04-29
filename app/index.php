<?php
	session_start();
	if($_SESSION['loggedin']==True){
		header("Location: landing.php");
		exit();
	}
?>

<!doctype html>
<html lang="en">
	
<head>
	<title>CMPT 470 A2P1</title>
	<link href="https://fonts.googleapis.com/css?family=Nanum+Gothic&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<meta charset="utf-8" />
	<meta name="keywords" content="math, Euler, pi, geometry" />
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
	
	
</head>

<body>
	<?php include("header.php"); ?>

<div id="input_form" class="container">
	<form id="form1" action="server/action.php" method="POST">
		<h3>LOGIN</h3>
		<input id="name" type="text" name="userName" placeholder="Your Name" required><br>
		<input id="password" type="password" name="userPassword"placeholder="Your Password" required><br>
		<input type="submit" value="Login">
		
	</form>
</div>

<br/>
	
</body>
</html> 
