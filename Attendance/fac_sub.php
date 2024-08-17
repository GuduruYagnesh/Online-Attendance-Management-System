<?php
@session_start();
include 'title.php';
include 'db_connect.php';
include 'db_connectstu.php';
include 'bs.html';
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
// $_SESSION['Starting_Period']=$stperiod;
// $_SESSION['Total_Periods']=$ttperiod;
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
if($res->num_rows == 0){
  // $i=0;
  foreach($options as $option){
    $temp=$_POST[$option['sid']];
    $attend[]=$temp*$ttperiod;
    // echo $_POST[$option['sid']];
    // echo $attend[$i];
    // $i++;
     }
   //print_r($attend);
   //echo $attend[2];
   $terror=false;
   $i=0;
   foreach($options as $option){
   $feildval1=mysqli_real_escape_string($connect,$option['sid']);
   $feildval2=mysqli_real_escape_string($connect,$option['email']);
   
   $query="INSERT INTO student_records(student_id,student_name,faculty_name,sub_name,branch,year,sem,regulation,date,periods_attended,total_periods,st_period) VALUES('$feildval1','$feildval2','$usefac','$subat','$branchat','$yearat','$semat','$regat','$date','$attend[$i]','$ttperiod',$stperiod)";
   $i++;
   if(mysqli_query($connect,$query)){
   $terror=true;
   }
   }
   if($terror){?>
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
          color: DodgerBlue;
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
    <h3><strong>Success!</strong> Attendance have been submitted successfully.</h3>
    </div>
   <hr>
   <?php
   $querya="SELECT * FROM student_records WHERE periods_attended = 0 and
                                                date='$date'and 
                                                st_period='$stperiod' and
                                                regulation='$regat' and  
                                                year='$yearat' and 
                                                branch='$branchat' and 
                                                sem='$semat' and 
                                                sub_name='$subat'";
    $resa=$connect->query($querya);
    if($resa->num_rows>0){
     $optiona=mysqli_fetch_all($resa,MYSQLI_ASSOC);
   }
   $l=1;
   if($resa->num_rows>0){
   ?>
   <h4 align='center'><b>List of absentees.</b></h4>
   <table align="center" class="table table-hover">
    <tr>
      <th>S.no</th>
      <th>Adm.No</th>
      <th>Student Name</th>
   </tr>
   <?php foreach($optiona as $opt){
   ?>
   <tr>
    <td><?php echo $l;?></td>
    <td><?php echo $opt['student_id'];?></td>
    <td><?php echo $opt['student_name'];?></td>
   </tr>
   <?php 
   $l++;
   }
   ?>
   </table>
   <br><br>
   <?php 
   }
   else{?>
    <h4 align='center'><b>There are no absentees.</b></h4>
   <?php
   }
   ?>
   </html>
   <?php
   }
   else{
   echo "failure";
   }
  }
  //else condition for udating attendance.
  else{?>
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
      .btn1 {
        background-color: white;
        border: none;
        color: DodgerBlue;
        padding: 12px 16px;
        font-size: 18px;
        cursor: pointer;
      }
      .btn {
        background-color: #1a75ff;
        border: none;
        color: white;
        padding: 12px 16px;
        font-size: 16px;
        cursor: pointer;
      }
      .log{
        position : absolute;
        left : 1420px;
        top:5px;
      }
      .sl{
        position : absolute;
        left : 390px;
        top:185px;
      }
      </style>
   </head>
   <div class="log">
   <button class="btn1" onClick="window.location.href='fac_attend.php';"><i class="fa fa-home"></i>Home</button>
    </div>
    <br><br><hr>
    <div class="alert alert-warning">
    <h3><strong>Warning!</strong> Attendance for this class was already submitted.<h3>
    </div>
    <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If you want any further updation click here.</h4>
    <!-- Update button -->
    <div class="sl">
    <a href="updateattendence.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-edit"></span> Update 
        </a>
    </div>
    <hr>
   <?php
   $querya="SELECT * FROM student_records WHERE periods_attended = 0 and
                                                date='$date'and 
                                                st_period='$stperiod' and
                                                regulation='$regat' and  
                                                year='$yearat' and 
                                                branch='$branchat' and 
                                                sem='$semat' and 
                                                sub_name='$subat'";
    $resa=$connect->query($querya);
    if($resa->num_rows>0){
     $optiona=mysqli_fetch_all($resa,MYSQLI_ASSOC);
   }
   $l=1;
   ?>
   <?php if($resa->num_rows>0){?>
  <h4 align='center'><b>List of absentees.</b></h4>
   <table align="center" class="table table-hover">
    <tr>
      <th>S.no</th>
      <th>Adm.No</th>
      <th>Student Name</th>
   </tr>
   <?php foreach($optiona as $opt){
   ?>
   <tr>
    <td><?php echo $l;?></td>
    <td><?php echo $opt['student_id'];?></td>
    <td><?php echo $opt['student_name'];?></td>
   </tr>
   <?php 
   $l++;
   }
   ?>
   </table>
   <br><br>
   <?php 
   }
   else{?>
    <h4 align='center'><b>There are no absentees.</b></h4>
   <?php
   }
   ?>
    </html>
  <?php 
}?>
   