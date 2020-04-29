<?php
	session_start();
	$isValid = $_SESSION['loggedin'];
	$histogram = $_SESSION['histogram'];
	$largest = $_SESSION['largest'];
	$total = $_SESSION['total'];
	$students = $_SESSION['students'];
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
	<script type="text/javascript" src="/myscripts.js"></script>
	
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

<div class="container" <?php echo ($isValid==True)?(""):("hidden"); ?>>
	<div class="div1">

		<h2>Grades Histogram</h2>
		<table class="table">
			<thead>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</thead>
			<?php
				foreach($histogram as $grade){
					$percentage = ($largest==0)?(0):($grade['count']/$largest*100);
					$width = ceil($percentage);
					$str = "<tr>
								<td>{$grade['letter']}</td>
								<td colspan=\"10\">";
					
					$str .= ($width==0)?"":"<div class=\"skills\" style=\"width:{$width}%\"><strong style=\"padding:5px;\">{$grade['count']} </strong></div>";
					
					$str .= "</td></tr>";
					echo $str;
				}
			?>
			
		</table>
	</div>
</div>
<br/>
<div class="container" <?php echo ($isValid==True)?(""):("hidden"); ?>>
	<div class="div1">
		<h2>Individual Student Grade Report</h2>
		<table class="table">
			<thead>
		<?php
			$i = 0;
			$str = "";
			foreach($total as $key=>$value){
				if($i%2==0){

					$str .= ($i==0)?"<th>{$key}</th>":"<th>{$key} ({$value}%)</th>";
				}
				$i++;
			}
			$str .= "<th>final percentage (100%)</th><th>letter grade</th>";
			$str .= "<tbody>";
			foreach($students as $student){
				$str .= "<tr>";
				$k = 0;
				foreach($student as $key=>$value){
					if($k%2==0&&!is_numeric($key)){
						$str .= (!is_numeric($value)||$key=="studentID"||$key=="letter_grade")?"<td>{$value}</td>":"<td>{$value}%</td>";
					}
					$k++;
				}
			}
			$str .= "</tbody>";
			echo $str;
		?>
	</div>
</div>

	
</body>
</html> 
