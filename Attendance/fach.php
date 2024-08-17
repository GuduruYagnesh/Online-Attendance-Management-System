<?php
@session_start();
include 'title.php';
$username=$_SESSION['user'];
$branch=$_SESSION['branch'];

include 'head.php';
include "db_connect.php";
$regf=$_POST['regulation1'];
$yearf=$_POST['year1'];
$semf=$_POST['sem1'];
//echo $regf;
//echo $yearf;
//echo $semf;
$_SESSION['regf']=$regf;
$_SESSION['yearf']=$yearf;
$_SESSION['semf']=$semf;
$query1="SELECT distinct fname from fac_course where branch = '$branch' and regulation='$regf' and year='$yearf' and sem='$semf'";
$result1 = $conn->query($query1);
if($result1->num_rows>0){
  $options1=mysqli_fetch_all($result1,MYSQLI_ASSOC);
} 

$query2="SELECT distinct subject from fac_course where branch = '$branch' and regulation='$regf' and year='$yearf' and sem='$semf'";
$result2 = $conn->query($query2);
if($result2->num_rows>0){
  $options2=mysqli_fetch_all($result2,MYSQLI_ASSOC);
} 
?>
<html>

<head>

</head>

<body>
<br><br>
<form align="center" method="POST" action="uph.php">
    <label>faculty:</label>
    <select name="fac1" >
        <option value=" ">faculty</option>
        <?php 
    foreach($options1 as $option){
  ?>
  <option value="<?php echo $option['fname'] ;?>" ><?php echo $option['fname'] ?></option>
  <?php
  }
 ?>
 </select>
 <br><br>
 <label>subject:</label>
    <select name="subb1" >
        <option value=" ">subject</option>
        <?php 
    foreach($options2 as $option){
  ?>
  <option value="<?php echo $option['subject'] ;?>" ><?php echo $option['subject'] ?></option>
  <?php
  }
 ?>
 </select>
 <br><br>
<input type="submit">
</form>
</body>

</html>