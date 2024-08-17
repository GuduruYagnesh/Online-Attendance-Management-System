<?php
@session_start();

include "head.php";
include 'title.php';
include 'bs.html';
include "db_connectstu.php";
include "db_connect.php";

error_reporting(E_ERROR | E_PARSE);

$username=$_SESSION['user'];
$branch=$_SESSION['branch'];
$br_code=$_SESSION['br_code'];
$regf=$_POST['reg'];
$yearf=$_POST['year'];
$semf=$_POST['sem'];
$st_dateh=$_POST['date1'];
$en_dateh=$_POST['date2'];


$stdateh=date("d-m-Y",strtotime($st_dateh));
$endateh=date("d-m-Y",strtotime($en_dateh));
$queryx="SELECT DISTINCT  student_id FROM student_records 
                                             WHERE date between '$stdateh' and '$en_dateh' and
                                             regulation='$regf' and  
                                             year='$yearf' and 
                                             branch='$branch' and 
                                             sem='$semf'";
                                             
$resx=$connect->query($queryx);
if($resx->num_rows>0){
    $optionx=mysqli_fetch_all($resx,MYSQLI_ASSOC);
     }
     foreach($optionx as $option){
     }
     if($resx->num_rows>0){
    $st_i=implode(" ",$optionx[0]);
     }
     else{
        echo '<script type="text/javascript">
    alert("please select a valid details"); 
    document.location.href ="report_sel.php";
</script>';
     }
$queryx1="SELECT DISTINCT subject FROM fac_course 
                                             WHERE regulation='$regf' and  
                                             year='$yearf' and 
                                             branch='$branch' and 
                                             sem='$semf'";
                                             
$resx1=$conn->query($queryx1);
if($resx1->num_rows>0){
    $optionx1=mysqli_fetch_all($resx1,MYSQLI_ASSOC);
     }
$i=1;
?>
<html>
    <head>
        <style>
            .table-bordered{
                width:80%;
                align:center;
            }
            th,td{
                align:center;
            }
            .lf{
                text-align:right;
            }
            .log{
            position : absolute;
            left : 1420px;
            top: 40px;
            }
            /* Navbar container */
            .navbar {
                overflow: hidden;
                background-color: lightgrey;
                font-family: Arial;
            }
            /* Links inside the navbar */
            .navbar a ,b{
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
            /* print button */
            .print button{
                background-color: #00802b;
                color: white;
                padding: 8px 20px;
                margin: 10px 0;
                border: none;
                cursor: pointer;
                width: 20%;
                border-radius:10px;                    
            }
        </style>
    </head>
    <body>
    <div class="navbar">
        <b>ONLINE ATTENDANCE MANAGEMENT SYSTEM</b>
      <span class = "logout"><a href="check.php" class="glyphicon glyphicon-home" >Home</a></span>
      </div>
        <table align="center">
            <tr style="font-size:18px;">
                <td>Regulation: &nbsp;&nbsp;&nbsp;<?php echo $regf;?></td>
                <td>Year:&nbsp;&nbsp;&nbsp;<?php echo $yearf;?></td>
                <td>&nbsp;</td>
                <td>Semester:&nbsp;&nbsp;&nbsp;<?php echo $semf;?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>&nbsp;</td>
            </tr>
            <tr style="font-size:18px;">
                <td>FROM: &nbsp;&nbsp;&nbsp;<?php echo $stdateh;?></td>
                <td></td>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td>To: &nbsp;&nbsp;&nbsp;<?php echo $endateh;?></td>
            </tr>
        </table> 
        <hr>
        <br>
        <table align='center' class="table table-bordered">
        <tr>
            <th>S.No</th>
            <th>Roll No.</th>
            <?php foreach($optionx1 as $option){?>
                <th colspan="2"><?php echo $option['subject'];?></th>
            <?php
            }
            ?>
            <th>Total</th>
            <th>Percentage. %</th>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <?php
            foreach($optionx1 as $option){
                $subx=$option['subject'];
                $queryx2="SELECT sum(total_periods) FROM student_records WHERE date between '$stdateh' and '$en_dateh' and
                                                                                                                        regulation='$regf' and  
                                                                                                                        year='$yearf' and 
                                                                                                                        branch='$branch' and 
                                                                                                                        sem='$semf' and
                                                                                                                        sub_name='$subx' and
                                                                                                                        student_id='$st_i'";
$resx2=$connect->query($queryx2);
if($resx2->num_rows>0){
    $optionx2=mysqli_fetch_all($resx2,MYSQLI_ASSOC);
}
              
                foreach($optionx2 as $options){
                    ?>
                    <th><?php echo $options['sum(total_periods)'];?></th>
                    <th>%.</th>
                <?php
                $tot += $options['sum(total_periods)'];
                }
                                                                                              
            } 
            ?>
            <th><?php echo $tot;?></th>
            <th><?php echo ($tot/$tot)*100;?></th>
        </tr>
        <?php foreach($optionx as $option){
            $stu_i=$option['student_id'];?>
        <tr>
            <td><?php echo $i;?>
            <td><?php echo $stu_i; ?></td>
            <?php 
            foreach($optionx1 as $option){
                $subx=$option['subject'];
                $queryx3="SELECT sum(periods_attended),sum(total_periods) FROM student_records WHERE date between '$stdateh' and '$en_dateh' and
                                                                                                    regulation='$regf' and  
                                                                                                         year='$yearf' and 
                                                                                                      branch='$branch' and 
                                                                                                           sem='$semf' and
                                                                                                      sub_name='$subx' and
                                                                                                       student_id='$stu_i'";
                $resx3=$connect->query($queryx3);
                if($resx3->num_rows>0){
                $optionx3=mysqli_fetch_all($resx3,MYSQLI_ASSOC);
                }
                foreach($optionx3 as $options){
                    $stot=$options['sum(total_periods)'];
                    $spea=$options['sum(periods_attended)'];
                    if($stot!=0){
                    $sper=($spea/$stot)*100;
                    }
                    else{
                        $sper=0;
                    }
                ?>
                <td><?php echo $spea;?></td>
                <td><?php echo number_format((float)$sper, 2, '.', '');?></td>
                <?php
                        $tots += $options['sum(periods_attended)'];
                } ?>                                                                              
           <?php
           //$x++; 
            }
            $stot=($tots/$tot)*100;
            ?>   
            <td><?php echo $tots;?></td>
            <td><?php echo number_format((float)$stot, 2, '.', '');?></td>
            <?php $tots= null;?>
        </tr>
        <?php 
        $i++;
        }
        ?>
       </table>
       <div align="center" class="print">
    <button onclick="window.print()" align="center">Print the attendance</button>
          </div><br><br>
    </body>
</html>
