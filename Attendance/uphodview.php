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
$date1=$_POST['date1'];
$date2=$_POST['date2'];

$_SESSION['reg']=$regf;
$_SESSION['year']=$yearf;
$_SESSION['sem']=$semf;
$_SESSION['facf']=$facf;
$_SESSION['subf']=$subf;
$_SESSION['date1']=$date1;
$_SESSION['date2']=$date2;

$newdate1=date("d-m-Y",strtotime($date1));
$newdate2=date("d-m-Y",strtotime($date2));
$i=1;
// echo $username;
// echo $branch;
// echo $regf;
// echo $yearf;
// echo $semf;
// echo $facf;
// echo $date1;
// echo $speriod;
$query1="SELECT DISTINCT  student_id,student_name,sub_name FROM student_records 
                                             WHERE regulation='$regf' and  
                                             year='$yearf' and 
                                             branch='$branch' and 
                                             sem='$semf' and 
                                             sub_name='$subf'
                                             HAVING '$date1'<'date'<'$date2'";
   $result1=$connect->query($query1);
   if($result1->num_rows>0){
    $options=mysqli_fetch_all($result1,MYSQLI_ASSOC);
  }
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

  <body>
    <div class="navbar">
      <span class = "logout"><a href="check.php" class="glyphicon glyphicon-home" >Home</a></span>
      </div>
    <table align="center">
      <tr>
        <td><b>From Date: </b><?php echo $newdate1;?></td>
        <td>&nbsp;&nbsp;||&nbsp;&nbsp;</td>
        <td><b>To Date: </b><?php echo $newdate2;?></td>
      </tr>
    </table>
    <hr>
     <?php if($result1->num_rows>0){?>
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
                            $query2="SELECT  student_id,student_name,sub_name,sum(total_periods),sum(periods_attended) FROM student_records 
                            WHERE date between '$date1' and '$date2' and
                            regulation='$regf' and  
                            year='$yearf' and 
                            branch='$branch' and 
                            sem='$semf' and 
                            sub_name='$subf'
                            and student_id= '$student' and student_name='$name'";
$res2=$connect->query($query2);
if($res2->num_rows>0){
$options1=mysqli_fetch_all($res2,MYSQLI_ASSOC);
}
?>
            <?php foreach ($options1 as $option){?>
            <tr>
                <td><?php  echo $i;?></td>
                <td><?php  echo $option['student_id']; ?></td>
                <td><?php  echo $option['student_name']; ?></td>
                <td><?php  echo $option['sub_name']; ?></td>
                <td><?php  echo $option['sum(total_periods)'] ?></td>
                <td><?php  echo $option['sum(periods_attended)']; ?></td>
                <td><?php  echo ($option['sum(periods_attended)']/$option['sum(total_periods)'])*100 .'%'; ?></td>
                <?php
                $i++;
                 }
            }?>
            </table>
            <?php
}
?>
            <div align="center" class="print">
              <button onclick="window.print()" align="center">Print the Attendance</button>
          </div><br><br>
  </body>
</html>