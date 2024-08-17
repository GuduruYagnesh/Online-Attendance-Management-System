<?php
@session_start();
include 'head.php';
include 'bs.html';
include "db_connectstu.php";
$username=$_SESSION['user'];
$branch=$_SESSION['branch'];

$regf=$_POST['reg'];
$yearf=$_POST['year'];
$semf=$_POST['sem'];
$facf=$_POST['faculty'];
$subf=$_POST['subject'];
$date1=$_POST['date'];
$speriod=$_POST['s_period'];

$_SESSION['facf']=$facf;
$_SESSION['subf']=$subf;
$_SESSION['date1']=$date1;
$_SESSION['speriod']=$speriod;
$_SESSION['reg']=$regf;
$_SESSION['year']=$yearf;
$_SESSION['sem']=$semf;
$newdate=date("d-m-Y",strtotime($date1));
$query="SELECT * FROM student_records WHERE date='$date1'and 
                                            faculty_name='$facf' and
                                            st_period='$speriod' and
                                            regulation='$regf' and  
                                            year='$yearf' and 
                                            branch='$branch' and 
                                            sem='$semf' and 
                                            sub_name='$subf'";
   $result=$connect->query($query);
   if($result->num_rows>0){
    $options=mysqli_fetch_all($result,MYSQLI_ASSOC);
  }
$_SESSION['tt_period']=$options[0]['total_periods'];
?>
<html>
  <head>
    <style>
      .table-hover{
        width:70%;
        align:center;
      }
      th,td{
        align:right;
      }
      .kl{
        align:right;
      }
      .fl{
        text-align:center;
        font-size:18px;
      }
      input[type=submit]{
        background-color: #00802b;
        color: white;
        padding: 8px 20px;
        margin: 10px 0;
        border: none;
        cursor: pointer;
        width: 10%;
        border-radius:10px;                    
      }
    </style>    
  </head>
  <body>
    <br>
    <?php if($result->num_rows>0){?>
        <table align="center">
          <tr style="font-size:18px;">
            <td><b>Subject :</b> &nbsp;<?php echo $subf;?></td>
            <td><b>Regulation :</b>&nbsp;<?php echo $regf;?></td>
          </tr>
          <tr style="font-size:18px;">
            <td><b>Faculty :</b>&nbsp;<?php echo $facf;?>&nbsp;&nbsp;</td>
            <td><b>Year :</b>&nbsp;<?php echo $yearf;?></td>
          </tr>
          <tr style="font-size:18px;">
            <td><b>Date :</b>&nbsp;<?php echo $newdate;?></td>
            <td><b>Semester :</b>&nbsp;<?php echo $semf;?></td>
          </tr>
        </table>     
      <hr>
      <form action="updbh.php" align="center" method="POST">
        <table align="center" width=100 class="table table-hover">
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
      </form>
      <?php 
    }
    else{
      echo '<script type="text/javascript">
      alert("please select a valid details"); 
      document.location.href ="reg_select.php";
      </script>';
    }?>
  </body>
</html>