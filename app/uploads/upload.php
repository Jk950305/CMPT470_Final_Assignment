<?php
session_start();
$target_dir = "";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


if ($_FILES["fileToUpload"]["size"] > 500000) {
    $uploadOk = 0;
}

if($imageFileType != "csv" ) {
    $uploadOk = 0;
}

if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $csv2arr = $fields = array(); $i = 0;
        $handle = @fopen($target_file, "r");
        if ($handle) {
            while (($row = fgetcsv($handle, 4096)) !== false) {
                if (empty($fields)) {
                    $fields = $row;
                    continue;
                }
                $count = 0;
                foreach ($row as $k=>$value) {
                    $stipped = str_replace(' ', '', $fields[$k]);
                    $csv2arr[$i][$stipped] = str_replace(' ', '', $value);
                    $csv2arr[$i][$count] = str_replace(' ', '', $value);
                    $count++;
                }
                $i++;
            }
            if (!feof($handle)) {
                echo "Error: unexpected fgets() fail\n";
            }
            fclose($handle);
        }

        unlink($target_file);

        $csv = $csv2arr;
        $students = array();
        $total = array();
        $outof = 0;
        foreach($csv as $student){
            $trimmed_id = str_replace(' ', '', $student[0]);
            if(strcmp($trimmed_id,"total")!=0){
                $students[] = $student;
            }else{
                $outof = 0;
                $total = $student;

                for($i=0;$i<count($total);$i++){
                    if($total[$i]!="total"){
                        $outof += $total[$i];
                    }
                }
            }
        }

        if($outof!=100){
            $_SESSION["upload"] = "The total of the semester should sum to 100.";
            header("Location: ../landing.php");
        }else{
            $i=0;
            foreach($students as $student){
                $final_percentage = 0;
                for($j=0;$j<count($student);$j++){
                    if($j>0&&$student[$j]!=null){
                        $final_percentage += ($student[$j]/100*$total[$j]);
                    }
                }
                $students[$i]["final_percentage"] = $final_percentage; 
                $students[$i][] = $final_percentage; 
                $i++;
            }
            $_SESSION["students"] = $students;
            $_SESSION["total"] = $total;
            header("Location: ../cutoffs.php");
        }        
    }
}else{
    $_SESSION["upload"] = "Please Upload another file.";
    header("Location: ../landing.php");
}
exit();
?>