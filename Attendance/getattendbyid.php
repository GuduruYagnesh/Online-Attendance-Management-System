<?php
session_start();
include 'title.php';
include 'bs.html';
error_reporting(E_ERROR | E_PARSE);
$today=date('Y-m-d');
$subdata=$_POST['subject'];
$splitdata=preg_split("/[-]+/",$subdata);
//print_r($splitdata);
$_SESSION['subc']=$splitdata[0];
$_SESSION['brac']=$splitdata[1];
$_SESSION['yearc']=$splitdata[2];
$_SESSION['semc']=$splitdata[3];
$_SESSION['regc']=$splitdata[4];
$_SESSION['br_code']=$splitdata[5];
$subat=$_SESSION['subc'];
$branchat=$_SESSION['brac'];
$usefac=$_SESSION['user'];
$yearat=$_SESSION['yearc'];
$semat=$_SESSION['semc'];
$br_codeat=$_SESSION['br_code'];
$regat=$_SESSION['regc'];
$adm_no= $_POST['adm_no'];
include 'db_connectstu.php';
$i=1;
?>
<html>
<style>
 .table-hover{
        width:70%;
        align:center;
      }
      th,td{
        align:center;
      }
      .kl{
        text-align:right;
      }
      .btn {
        background-color: white;
        border: none;
        color: DodgerBlue;
        padding: 12px 16px;
        font-size: 16px;
        cursor: pointer;
      }
      .log{
        position : absolute;
        left : 1420px;
        top:5px;
      }
</style>
  <body>
  <div class="log">
  <button class="btn" onClick="window.location.href='fac_attend.php';"><i class="fa fa-home"></i>Home</button>
  </div>
    <br><br><br><br>
    <table align="center">
            <tr style="font-size:18px;">
                <td><b>Adm.No :</b> &nbsp;&nbsp;&nbsp;<?php echo $adm_no;?></td>
            </tr>
    </table><br><br>
  <!-- <form method='GET' align='center'>
  <input type='text' name="adm_no" PlaceHolder='admission no.'>
      <input type='submit'>
    </form><br> -->
     <?php 
     $sta="SELECT sub_name,date,total_periods,periods_attended from student_records 
                                                                 where regulation='$regat' and  
                                                                 year='$yearat' and 
                                                                 branch='$branchat' and 
                                                                 sem='$semat' and 
                                                                 sub_name='$subat' and
                                                                 student_id='$adm_no'";
                                                  
     $res=$connect->query($sta);
     if($res->num_rows>0){
         $options=mysqli_fetch_all($res,MYSQLI_ASSOC);
          }

     if($res->num_rows>0){?>
            <table align='center' class="table table-hover">
            <tr>
                <th>s.no</th>
                <th>subject</th>
                <th>Date </th>
                <th>Total periods</th>
                <th>No.of periods attended</th>
               
            </tr>
            <?php foreach ($options as $option){
              $newdate=date("d-m-Y",strtotime($option['date']));
              ?>
            <tr>
                <td><?php  echo $i; $i++?></td>
                <td><?php  echo $option['sub_name']; ?></td>
                <td><?php  echo $newdate; ?></td>
                <td><?php  echo $option['total_periods']; ?></td>
                <td><?php  echo $option['periods_attended']; ?></td>
                <?php
                 }
            }?>
            </table>
            <div align="center">
            <button onclick="window.print()" align="center">Print the attendance</button>
          </div>
  </body>
</html>
