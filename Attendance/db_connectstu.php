<?php
    $host = "localhost";
    $db = "attendence";
    $user = "root";
    $pass = "";

    $connect = new mysqli($host, $user, $pass, $db);
            
    if (mysqli_connect_errno()) {
        echo "Error in connection".mysqli_connect_errno();
    }
    

 ?>