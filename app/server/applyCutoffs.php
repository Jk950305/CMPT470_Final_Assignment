<?php
	session_start();
	if(isset($_POST["MAX"]) && isset($_POST["MIN"]) ) {
		$letters = $_SESSION["letters"];
		$students = $_SESSION["students"];
		$histogram = array();
		for($i=0;$i<count($letters);$i++){
			$histogram[$i]["letter"] = $letters[$i];
			$histogram[$i]["cutoff"] = $_POST[$letters[$i]];
			$histogram[$i]["count"] = 0;
		}
		$index = count($histogram);
		$j=0;
		foreach($students as $student){
			for($i=0;$i<count($histogram);$i++){
				if($student["final_percentage"] >= $histogram[$i]["cutoff"]){
					$students[$j]["letter_grade"] = $histogram[$i]["letter"];
					$students[$j][] = $histogram[$i]["letter"];
					$histogram[$i]["count"]++;
					break;
				}
			}
			$j++;
		}
		$_SESSION['students'] = $students;

		$largest = 0;
		foreach($histogram as $grade){
			if($largest<$grade['count']){
				$largest = $grade['count'];
			}
		}
		$_SESSION["largest"] = $largest;
		$_SESSION["histogram"] = $histogram;


	}
	header("Location: ../histogram.php");
	exit();
?>