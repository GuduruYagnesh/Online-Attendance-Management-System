<?php
@session_start();
include 'title.php';
include 'db_connectstu.php';
include 'bs.html';
$today=date('Y-m-d');
$subat=$_SESSION['subc'];
$branchat=$_SESSION['brac'];
$usefac=$_SESSION['user'];
$yearat=$_SESSION['yearc'];
$semat=$_SESSION['semc'];
$br_codeat=$_SESSION['br_code'];
$regat=$_SESSION['regc'];
$stperiod=$_SESSION['Starting_Period'];
$ttperiod=$_SESSION['Total_Periods'];
$date=$_SESSION['class_date'];
$query="SELECT * FROM student_records WHERE date='$date'and 
                                            st_period='$stperiod' and
                                            regulation='$regat' and  
                                            year='$yearat' and 
                                            branch='$branchat' and 
                                            sem='$semat' and 
                                            sub_name='$subat'";
   $result=$connect->query($query);
   if($result->num_rows>0){
    $options=mysqli_fetch_all($result,MYSQLI_ASSOC);
  }
  ?>
  <?php
  function datediff($today,$date){
    $diff=strtotime($today)-strtotime($date);
    return abs(round($diff/86400));
  }
  $datedif=datediff($today,$date);

?>
<?php 
if($datedif <= 7){
?>
<html>
<head>
<style>
 .table-hover{
        width:70%;
        align:center;
      }
      th,td{
        text-align:center;
      }
      .kl{
        align:right;
      }
</style>

</head>

<body >
<h4>Last updation of attendance had done  <?php echo $datedif .'days'; ?> ago.</h4>
  <div style="background: url('images/head.jpg') no-repeat center center fixed; background-size:cover;">
  <br>
<form action="fac_up.php" align="center" method="POST">
    <label for="date selection">Date:</label>
    <input type="date" id="class_date" name="class_date" value="<?php echo $date ;?>">
    <label for="Starting Seriod">Starting Period:</label>
    <select name="Starting_Period"  required>
      <option value="<?php echo $stperiod;?>"><?php echo $stperiod;?></option>
    </select>
    <label for="Total_Periods">Total Periods</label>
      <select name="Total_Periods" required>
      <option value="<?php echo $ttperiod;?>"><?php echo $ttperiod;?></option>
    </select>
      <br><br>
<table align="center" class="table table-hover">
<tr>
<th>S.no</th>
<th>Adm.no</th>
<th>Name</th>
<th>Attendence</th>
</tr>
<?php
$sn=1;
foreach($options as $option)
{
?>
<tr>
<td><?PHP echo $sn; ?></td>
<td><?php echo $option['student_id']; ?></td>
<td><?php echo $option['student_name']; ?></td>

<td align="center">
<?php if($option['periods_attended']>0){  ?>
<input type='radio' required="required" class="form-check-input" name='<?php echo $option['student_id'];?>' value=1 checked>
<label>present</label>
<input type='radio' required="required" class="form-check-input" name='<?php echo $option['student_id'];?>' value=0 ><label>absent</label>
<?php }
else{ ?>
  <input type='radio' required="required" class="form-check-input" name='<?php echo $option['student_id'];?>' value=1 >
  <label>present</label>
  <input type='radio' required="required" class="form-check-input" name='<?php echo $option['student_id'];?>' value=0 checked><label>absent</label>
<?php  } ?>
</td>
</tr>
<?php $sn++;
}
?>

</table>
<br>
<input type="submit" name="submit" value="submit">
<br><br>
</form>
<div>
</body>
</html>
<?php
}
else{
  ?>
  <html>
    <head>
      <style>
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
    <br><hr>
    <div class="alert alert-warning">
    <h3><strong>Warning!</strong> Time period for updating the attendance has been exceeded.</h3>
  </div>
    <h4>&nbsp;&nbsp;&nbsp;&nbsp;Contact the respected Head of the Department for updation of attendance</h4>
    </html>
<?php
}
?>