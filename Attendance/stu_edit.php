<?php
include 'title.php';
include 'head.php';
include "bs.html";
@session_start();
include 'db_connectstu.php';
include 'db_connect.php';
$stu_id = $_SESSION['user1'];
// echo $stu_id;
$queryl="SELECT email from st_login where sid='$stu_id'";
$resl = $conn->query($queryl);
if($resl->num_rows>0){
  $options=mysqli_fetch_all($resl,MYSQLI_ASSOC);
}
// updating the name.
if(!empty($_POST['stu_name'])){
    $stu_name = strtoupper($_POST['stu_name']);
    $query="UPDATE st_login set email='$stu_name' where sid='$stu_id'";
    if(mysqli_query($conn,$query)){
        echo '<script type="text/javascript">
        alert("Name updated Successfully!!"); 
        document.location.href ="student_menuhru.php";
    </script>';
        }
    else{
        echo '<script type="text/javascript">
                        alert("Error occured!"); 
                        document.location.href ="stu_edit.php";
                    </script>';
    }
}
?>
<html>
    <head>
        <style>
            .Name{
                align:center;
                font-size:20px;
            }
        </style>
    </head>
    <body>
        <div class="login_box"> 
            <form method="POST" action="#">
                <label><u>Present Name</u>:</label>
                <br>
                <span class="Name"><?php foreach($options as $option){
                                echo $option['email'];
                                } ?></span>
                <br>
                <label for="stu_name"><u>New Name</u>:</label>
                <input type="text" name="stu_name">
                <div align="center">
                    <input type="submit">
                </div>
            </form>
        </div>
    </body>
</html>
