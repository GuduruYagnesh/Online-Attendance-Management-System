<?php
include 'title.php';
include "bs.html";
include 'db_connectstu.php';
session_start();

error_reporting(E_ERROR | E_PARSE);
$subdata=$_POST['subject'];
$splitdata=preg_split("/[-]+/",$subdata);
$_SESSION['subc']=$splitdata[0];
$_SESSION['brac']=$splitdata[1];
$_SESSION['yearc']=$splitdata[2];
$_SESSION['semc']=$splitdata[3];
$_SESSION['regc']=$splitdata[4];
$_SESSION['br_code']=$splitdata[5];
$today=date('Y-m-d');
$subat=$_SESSION['subc'];
$branchat=$_SESSION['brac'];
$usefac=$_SESSION['user'];
$yearat=$_SESSION['yearc'];
$semat=$_SESSION['semc'];
$br_codeat=$_SESSION['br_code'];
$regat=$_SESSION['regc'];
// echo $today;
// echo $subat;
// echo $branchat;
// echo $usefac;
// echo $yearat;
// echo $semat;
// echo $br_codeat;
// echo $regat;

$st_date=$_POST['fdate'];
$en_date=$_POST['ldate'];
$stdate=date("d-m-Y",strtotime($st_date));
$endate=date("d-m-Y",strtotime($en_date));
$query1="SELECT DISTINCT  student_id,student_name,sub_name FROM student_records 
                                             WHERE regulation='$regat' and  
                                             year='$yearat' and 
                                             branch='$branchat' and 
                                             sem='$semat' and 
                                             sub_name='$subat'";
                                             
$res=$connect->query($query1);
if($res->num_rows>0){
    $options=mysqli_fetch_all($res,MYSQLI_ASSOC);
     }
//      $queryA="SELECT * FROM student_records  WHERE date between '$st_date' and '$en_date' ";
    
// $resA=$connect->query($queryA);
// if($resA->num_rows>0){
// $optionA=mysqli_fetch_all($resA,MYSQLI_ASSOC);
// }
// print_r($optionA);
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
        align:right;
      }
      .lf{
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
  <div class='log'>
  <button class="btn" onClick="window.location.href='fac_attend.php';"><i class="fa fa-home"></i>Home</button>
    <br>
  </div>
  <br><br><hr>
  <table align="center">
            <tr style="font-size:18px;">
                <td><b>Regulation :</b> &nbsp;&nbsp;&nbsp;<?php echo $regat;?></td>
                <td><b>Year :</b>&nbsp;&nbsp;&nbsp;<?php echo $yearat;?></td>
                <td>&nbsp;</td>
                <td><b>Semester :</b>&nbsp;&nbsp;&nbsp;<?php echo $semat;?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>&nbsp;</td>
            </tr>
            <tr style="font-size:18px;">
              <td></td>
              <td colspan = 3><b>Subject :</b>&nbsp;&nbsp;&nbsp;<?php echo $subat ;?></td> 
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>&nbsp;</td>
            </tr>
            <tr style="font-size:18px;">
                <td><b>FROM :</b>&nbsp;&nbsp;&nbsp;<?php echo $stdate;?></td>
                <td></td>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td><b>To :</b>&nbsp;&nbsp;&nbsp;<?php echo $endate;?></td>
            </tr>
        </table>
<!-- <div>
  <form onclick= "#" method="get" align="center">
  
      <label>From date:<input type='date' name="fdate" >
      <label>To date:<input type='date' name="ldate" >&nbsp;&nbsp;&nbsp;
      <input type='submit'>
    </form>
    </div> -->
<br>
     <?php if($res->num_rows>0){?>
       <table align='center' class="table table-hover">
       <tr>
           <th>s.no</th>
           <th>Student id</th>
           <th>student name</th>
           <th>subject</th>
           <th>Total periods</th>
           <th>No.of periods attended</th>
           <th>Percentage of Attendance</th>
       </tr>
        <?php foreach ($options as $option){ 
                            $student=  $option['student_id'];
                            $name= $option['student_name'];
                            $query2="SELECT  student_id,student_name,sub_name,sum(total_periods) as tperiods,sum(periods_attended) as speriods FROM student_records  WHERE  date between '$st_date' and '$en_date' and
                                                                                                                                                                            regulation='$regat' and  
                                                                                                                                                                            year='$yearat' and 
                                                                                                                                                                            branch='$branchat' and 
                                                                                                                                                                            sem='$semat' and 
                                                                                                                                                                            sub_name='$subat' and
                                                                                                                                                                            student_id= '$student' and 
                                                                                                                                                                            student_name='$name'";
                                                                                                                                                                           
$res2=$connect->query($query2);
if($res2->num_rows>0){
$options1=mysqli_fetch_all($res2,MYSQLI_ASSOC);
}

?>
            <?php foreach ($options1 as $opt){?>
            <tr>
                <td><?php  echo $i; $i++?></td>
                <td><?php  echo $opt['student_id']; ?></td>
                <td><?php  echo $opt['student_name']; ?></td>
                <td><?php  echo $opt['sub_name']; ?></td>
                <td><?php  echo $opt['tperiods'] ?></td>
                <td><?php  echo $opt['speriods']; ?></td>
                <?php if($opt['tperiods'] != 0){?>
                  <td><?php  echo ($opt['speriods']/$opt['tperiods'])*100 .'%'; ?></td>
                  <?php }
                  else{?>
                  <td><?php echo "0 %"; ?></td>
                  <?php  }
                    ?>
                <?php
                 }
            }?>
            </table>
            <?php
}
?>
            <div align="center">
    <button onclick="window.print()" align="center">Print the attendance</button>
          </div><br><br>
  </body>
</html>

