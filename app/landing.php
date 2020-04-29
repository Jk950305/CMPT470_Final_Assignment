<?php
	session_start();
	$isValid = $_SESSION['loggedin'];
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
	<div <?php echo ($isValid!=False)?(""):("hidden"); ?>><h3><a href="logout.php" style="color:white; float:right; margin-right:10px;">logout</a></h3></div>
	<br/>
<div class="container" <?php echo ($isValid==False)?(""):("hidden"); ?>>
	<div class="div1">
		<a href="index.php">Please login first</a>
	</div>
</div>
<div class="container" <?php echo ($isValid==True)?(""):("hidden"); ?> >
	<div class="div1">
		<form action="uploads/upload.php" method="post" enctype="multipart/form-data">
		    Select csv file to upload:
		    <input type="file" name="fileToUpload" id="fileToUpload">
		    <input style="background: #4CAF50; color: white" type="submit" value="Upload File" name="submit">
		</form>
		<p>
			<?php
				if(isset($_SESSION["upload"])){
					echo $_SESSION["upload"];
					$_SESSION["upload"] = null;
				}
			?>
		</p>
	</div>
</div>
	
</body>
</html> 
