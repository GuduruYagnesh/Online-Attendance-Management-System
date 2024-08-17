<?php 
session_start();
include "head.php";
include "bs.html";
//css file
echo "<link rel='stylesheet' type='text/css' href='css.css' />";

require('db_connect.php');
if(isset($_POST['studentname'])&&isset($_POST['stupass'])){
  $studentname=$_POST['studentname'];
  $stupass=$_POST['stupass'];
  if( empty($_POST['studentname']) && empty ($_POST['stupass'])){
    echo '<script type="text/javascript">
    alert("Please fill Username and Password..!"); 
    document.location.href ="studenthru.php";
</script>';
  }
else{ 
$query=("SELECT * FROM `st_login` where sid='".$_POST['studentname']."' and spass ='".$_POST['stupass']."'");
$result=mysqli_query($conn,$query);
if(mysqli_fetch_assoc($result)){
  $_SESSION['user1']=$studentname;
  header("location:student_menuhru.php");
}
else{
echo '<script type="text/javascript">
alert("Invalid Username and Password..!"); 
document.location.href ="studenthru.php";
</script>';
}
}
}
?>
<html>
  <body>
    <div class ="login_box">
      <form action="#" method="post">
        <div class="form" >
          <h3 align ="center"><b><u>STUDENT LOGIN</u></b></h3>
          <label for="username">user name:</label>
          <input type="text" name="studentname" placeholder = "Enter your username">
          <label for="password">password:</label>
          <input type="password" name="stupass" placeholder = "Enter your password">
          <div align="center">
          <input type="submit" name="stulogin"> 
          </div>
        </div>
      </form>
      <span class="psw"><a href="#"><u>Forgot password?</u></a></span>
    </div>
  </body>
</html>

