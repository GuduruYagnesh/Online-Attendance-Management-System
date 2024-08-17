<?php
@session_start();
include 'title.php';
include 'db_connect.php';
include "db_connectstu.php";
include "bs.html";
include "head.php";
$username=$_SESSION['user'];
$branch=$_SESSION['branch'];
$br_code=$_SESSION['br_code'];
$regf=$_SESSION['reg'];
$yearf=$_SESSION['year'];
$semf=$_SESSION['sem'];
$facf=$_SESSION['facf'];
$subf=$_SESSION['subf'];
$date1=$_SESSION['date1'];
$speriod=$_SESSION['speriod'];
$ttperiod=$_SESSION['tt_period'];
// echo $username;
// echo $branch;
// echo $regf;
// echo $yearf;
// echo $semf;
// echo $facf;
// echo $date1;
// echo $speriod;

$query="SELECT sid,email FROM st_login WHERE regulation='$regf' and  year='$yearf' and br_code='$br_code' and sem='$semf'";
   $result=$conn->query($query);
   if($result->num_rows>0){
    $options=mysqli_fetch_all($result,MYSQLI_ASSOC);
  }
$query1="SELECT * FROM student_records WHERE date='$date1'and 
                                             st_period='$speriod' and
                                             regulation='$regf' and  
                                             year='$yearf' and 
                                             branch='$branch' and 
                                             sem='$semf' and 
                                             sub_name='$subf' ";
  $res=$connect->query($query1);
  if($res->num_rows>0){
  foreach($options as $option){
  $temp=$_POST[$option['sid']];
  $attend[]=$temp*$ttperiod;
  }
  //print_r($attend);
  //echo $attend[2];
  $terror=false;
  $i=0;
  foreach($options as $option){
  $feildval1=mysqli_real_escape_string($connect,$option['sid']);
  $feildval2=mysqli_real_escape_string($connect,$option['email']);

  $query="UPDATE student_records set periods_attended=$attend[$i] where student_id='$feildval1'";
  $i++;
  if(mysqli_query($connect,$query)){
  $terror=true;
  }
  }
  if($terror){
?>
  <html>
    <head>
      <style>
            /* Navbar container */
            .navbar {
            overflow: hidden;
            background-color: lightgrey;
            font-family: Arial;
            }

            /* Links inside the navbar */
            .navbar a {
            float: left;
            font-size: 16px;
            color: black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            border-radius:10px;
            }
            .logout a:hover{
                float:right;
                background-color: #002699;
            }
            .logout {
                float:right;
            }
        </style>
    </head>
    <div class="navbar">
      <span class = "logout"><a href="check.php" class="glyphicon glyphicon-home" >Home</a></span>
      </div>
      <div class="alert alert-success">
      <h3><strong>Success!</strong> Attendance have been updated successfully.</h3>
    </div>
  </html>
<?php }
else{
echo "failure";
}
}?>

