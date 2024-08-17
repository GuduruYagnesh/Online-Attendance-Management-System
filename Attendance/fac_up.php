<?php
@session_start();
include 'title.php';
include 'db_connect.php';
include 'bs.html';

$current_date=date("Y-m-d");

$subat=$_SESSION['subc'];
$branchat=$_SESSION['brac'];
$usefac=$_SESSION['user'];
$yearat=$_SESSION['yearc'];
$semat=$_SESSION['semc'];
$br_codeat=$_SESSION['br_code'];
$regat=$_SESSION['regc'];
$query="SELECT sid,email FROM st_login WHERE regulation='$regat' and  year='$yearat' and br_code='$br_codeat' and sem='$semat'";
   $result=$conn->query($query);
   if($result->num_rows>0){
    $options=mysqli_fetch_all($result,MYSQLI_ASSOC);
  }
$stperiod=$_POST['Starting_Period'];
$ttperiod=$_POST['Total_Periods'];
$date=$_POST['class_date'];
$_SESSION['Starting_Period']=$stperiod;
$_SESSION['Total_Periods']=$ttperiod;
$_SESSION['class_date']=$date;
include 'db_connectstu.php';

$query1="SELECT * FROM student_records WHERE date='$date'and 
                                             st_period='$stperiod' and
                                             regulation='$regat' and  
                                             year='$yearat' and 
                                             branch='$branchat' and 
                                             sem='$semat' and 
                                             sub_name='$subat' ";
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
  //  $queryr="INSERT into log_details(s_no,updated_date,fac_name,year,sem,regulation,branch,sub_name,class_date,st_period,tt_period	) VALUES('$current_date','$usefac','$yearat','$semat','$regat','$branchat','$subat','$date','$stperiod','$ttperiod')";
  //  if(mysqli_query($connect,$queryr)){
  //   $terror=true;
  //   // echo "hello world";
  //   // echo $current_date;
  //   }
   if($terror){
   ?>
   <html>
   <head>
    <style>
      .table-hover{
        width:70%;
        align:center;
      }
      th,td{
        text-align : center;
      }
      .btn {
        background-color: white;
        border: none;
        color: Dodgerblue;
        padding: 12px 16px;
        font-size: 18px;
        cursor: pointer;
      }
      .log{
        position : absolute;
                left : 1420px;
                top:5px;
      }
      </style>
   </head>
   <div class="log">
   <button class="btn" onClick="window.location.href='fac_attend.php';"><i class="fa fa-home"></i>Home</button>
    </div>
    <br><br>
    <hr>
    <div class="alert alert-success">
    <h3><strong>Success!</strong> Attendance have been updated successfully.</h3>
  </div>
   </html>
   <?php }
   else{
   echo "failure";
   }
  }?>