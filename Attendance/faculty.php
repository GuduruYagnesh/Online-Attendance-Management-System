<?php
session_start();
include "head.php";
include "bs.html";
//css file
echo "<link rel='stylesheet' type='text/css' href='css.css' />";

date_default_timezone_set("Asia/Kolkata");
if(!empty($_POST['facultyname']) && !empty($_POST['facultypass'])){    
        $username = strtoupper($_POST['facultyname']);
        $password = strtoupper($_POST['facultypass']);
        require("logindetails.php");
        $opt = new Operations();
        $res = $opt->checkStaffLogin($username, $password);

            if($res['status'] == 'success'){
                $_SESSION['user'] = $res['user'];
                header('Location:fac_attend.php');
                            
            }else{
                echo '<script type="text/javascript">
                        alert("Invalid Username or Password..!"); 
                        document.location.href ="faculty.php";
                    </script>';
            }
}
else if(!empty($_POST['facultyname']) && empty($_POST['facultypass'])){
                echo '<script type="text/javascript">
                        alert("please enter the required details"); 
                        document.location.href ="faculty.php";
                    </script>';
}
?>

<html>
    <body>
        <div class = "login_box">
                <form onclick="fac_attend.php" method="post">
                    <div class ="form">
                        <h3 align = "center"><b><u>FACULTY LOGIN</u></b></h3>
                        <label>user name:</label>
                        <input type="text" name="facultyname" placeholder = "Enter your username">
                        <label>password:</label>
                        <input type="password" name="facultypass" placeholder = "Enter your password" id ="id_password">
                        <div align = "center">
                            <input type="submit" name="facultylogin">
                        </div>
                    </div>    
                </form>
                <span class="psw"><a href="#"><u>Forgot password?</u></a></span>
        </div>
    </body>
</html>