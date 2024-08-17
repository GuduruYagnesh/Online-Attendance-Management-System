<?php
@session_start();
include 'head.php';

include "db_connect.php";
$username=$_SESSION['user'];
$branch=$_SESSION['branch'];
error_reporting(E_ERROR | E_PARSE);
// $regf=$_SESSION['regf'];
// $yearf=$_SESSION['yearf'];
// $semf=$_SESSION['semf'];
// $_SESSION['facf']=$_POST['fac1'];
// $_SESSION['subf']=$_POST['subb1'];
// $facf=$_SESSION['facf'];
// $subf=$_SESSION['subf'];

$regf=$_POST['regulation1'];
$yearf=$_POST['year1'];
$semf=$_POST['sem1'];

$_SESSION['regf']=$regf;
$_SESSION['yearf']=$yearf;
$_SESSION['semf']=$semf;


// $date1=$_GET['date1'];
// $speriod=$_GET['s_period'];
// $facf=$_GET['fac1'];
// $subf=$_GET['subb1'];

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

// $query="SELECT * from student_records where date='$date1' and 
//                                                      faculty_name='$facf' and
//                                                      st_period='$speriod' and
//                                                      regulation='$regf' and  
//                                                      year='$yearf' and 
//                                                      branch='$branch' and 
//                                                      sem='$semf' and
//                                                      sub_name='$subf'
//                                                      ";
// $result=$connect->query($query);

// if($result->num_rows>0){
//     $options=mysqli_fetch_all($result,MYSQLI_ASSOC);
    
//         }
// echo $date1;
// echo $speriod;
// echo $branch;
// echo $facf;
// echo $subf;
// echo $regf;
// echo $yearf;
// echo $semf;
if($result1->num_rows>0){
    if($result2->num_rows>0){?>
<html>
    <head>
        <style>
        table{
                border:2px solid black;
                border-collapse:collapse;
                width:70%;
                align:center;
            }
            th,td{
                border:0.5px solid black;
            }
            .kl{
                align:right;
            }
        </style>
    </head>
    <body>
        <br><br>
        <form align="center" method="POST" action="uphodview.php">
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
            <label>From Date:</label>
            <input type="date" name="date1">
            <label>To Date:</label>
            <input type="date" name="date2">
            
            <br><br>
            <input type="submit">
        
    </body>
</html>
<?php
}
}
else{
    echo '<script type="text/javascript">
    alert("please select a valid details"); 
    document.location.href ="reg_select.php";
</script>';
}?>
