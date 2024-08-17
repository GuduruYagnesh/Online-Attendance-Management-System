<?php 
session_start();
include 'title.php';
include 'head.php';
require("db_connectstu.php");
error_reporting(0);
$studentid=$_SESSION['user1'];
?>
<html>
<head>
    <style>
        .table-hover{
        width:70%;
        align:center;
      }
      th,td{
        align:center;
      }
        .btn{
            right: 30px;
        }
        .box5{
    }
    </style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<!--<div class=select>
<lable>SUBJECT:</lable>
<select name="subject">
    <option value="CP">C-PROGRAMMING-LANGUAGE</option>
    <option value="html">HTML</option>
    <option value="mefa">MEFA</option>
    <option value="python">PYTHON</option>
  </select>
</div>
<div class=submit>
<button type="submit" name="button" class="btn-btn-primary">SUBMIT</button>
</div>
</div>-->
<body>
    <div class="border2">
        <div class="card-body" style="padding: 30px;">
            <form action="" method="GET">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>From Date</label>
                        <input type="date" name="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>To Date</label>
                        <input type="date" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Select</label>
                        <select name="course" class="form-control">           
                            <option>SELECT</option>
                            <?php 
                                $conn=mysqli_connect("localhost","root","","attendence");
                                $sql="SELECT distinct sub_name from student_records where student_id='$studentid'";
                                $res=mysqli_query($conn , $sql);while($row=mysqli_fetch_array($res)){
                            ?>
                            <option value="<?php echo $row['sub_name'];?> " ><?php echo $row['sub_name']; ?> </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="btn">
                    <div class="form-group"style="padding:20px;">
                        <button type="submit" class="btn btn-primary">GET</button>
                    </div>
                </div>
        </div>
    </div>
                            <div class="box5" >
     <h3>&nbsp;&nbsp;&nbsp;&nbsp; <label> <?php echo $_GET['course'];;?></label></h3>
     <br>
     <br>
                        </form>
                    </div>
                </div>
                

                <div class="card mt-3">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th></th>
                                <th></th>
                                    <th>DATE</th>
                                    <th> PERIODS CONDUCTED </th>
                                    <th>PERIODS ATTENDED</th>
                                    
                
                                </tr>
                            </thead>
                            <tbody>
                            
                            <?php 
                                $conn = mysqli_connect("localhost","root","","attendence");
                                $total=0;

                                if(isset($_GET['from_date']) && isset($_GET['to_date']) && isset($_GET['course']))
                                {   
                                    $from_date = $_GET['from_date'];
                                    $to_date = $_GET['to_date'];
                                    $_SESSION["subject"] = $_GET['course'];
                                    

                                    $query = "SELECT sub_name,date,total_periods , periods_attended ,sum(total_periods) as tp, sum(periods_attended) as pa,sum(periods_attended)/sum(total_periods) * 100 as 'percentage' FROM student_records  WHERE date BETWEEN '$from_date' AND '$to_date'and sub_name='".($_SESSION['subject'])."' and student_id ='".($_SESSION['user1'])."' group by date";
                                  /*  $query = "SELECT sub_name , sum(total_periods) FROM student_records  WHERE date BETWEEN '$from_date' AND '$to_date' and student_id = '" .($_SESSION['user1']) ."'";*/
                                    $query_run = mysqli_query($connect, $query);


                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $row)
                                        {
                                           
                                            ?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td><?= $row['date']; ?></td>
                                                <td><?= $row['total_periods']; ?></td>
                                                <td><?= $row['periods_attended']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "No Record Found";
                                    }
                            
                            ?>
                            </tbody>
                            <tfoot>
                
                            <tbody>
                            
                            <?php 
                                $conn = mysqli_connect("localhost","root","","attendence");
                               

                                    $query1 = "SELECT sub_name,sum(total_periods) as tp, sum(periods_attended) as pa,sum(periods_attended)/sum(total_periods) * 100 as 'percentage' FROM student_records  WHERE date BETWEEN '$from_date' AND '$to_date'and sub_name='".($_SESSION['subject'])."' and student_id ='".($_SESSION['user1'])."' group by sub_name";
                                  /*  $query = "SELECT sub_name , sum(total_periods) FROM student_records  WHERE date BETWEEN '$from_date' AND '$to_date' and student_id = '" .($_SESSION['user1']) ."'";*/
                                    $query_run1 = mysqli_query($connect, $query1);


                                    if(mysqli_num_rows($query_run1) > 0)
                                    {
                                        foreach($query_run1 as $row1)
                                        {
                                           
                                            ?>
                                            <tr>
                                            <th></th>
                                            <th></th>
                                                
                                                
                                            <td></td>
                                                <td> TOTAL = <?= $row1['tp']; ?></td>
                                                <td>TOTAL = <?= $row1['pa']; ?></td>
                                                <td>PERCENTAGE = <?= $row1['percentage']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                }
                                    ?>
                          </tfoot>
                            </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
   
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>