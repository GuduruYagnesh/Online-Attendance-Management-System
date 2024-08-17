<?php
@session_start();
include "db_connect.php";
if(!empty($_POST['reg']) && !empty($_POST['year']) && !empty($_POST['sem'])){
    $resf="<option>--Select--</option>";
    $reg = $_POST['reg'];
    $year = $_POST['year'];
    $sem = $_POST['sem'];
    $branch = $_SESSION['branch'];
    $br_code = $_SESSION['br_code'];
    $fnames = array();
    $i=0;
    if($stmt = $conn->prepare("SELECT Distinct `fname` FROM `fac_course` WHERE `regulation`=? AND `branch`=? AND `year`=? AND `sem`=?;")){
        $stmt->bind_param("ssss", $reg, $branch, $year, $sem);
        if($stmt->execute()){
            $stmt->bind_result($faculty);
            while($stmt->fetch()){
                $fnames[$i++] = $faculty;
            }
        }
        $stmt->close();
    }
    for($j=0;$j<=$i;$j++){
        $resf.= "<option value='".$fnames[$j]."'>".$fnames[$j]."</option>";
    }
    echo $resf;
}