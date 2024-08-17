<?php 
session_start();
include 'title.php';
include 'head.php';
error_reporting(E_ERROR | E_PARSE);
require("db_connectstu.php");
$k=$_POST['id'];
$k=trim($k);
?>
<html>
<head>
<script type="text/javascript" src="selectSubject.js"></script>
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
                                    <div class="form-group"style="padding:20px;">
                                      <button type="submit" class="btn btn-primary">GET</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-borderd">
                            <thead>
                                <tr>
                                    <th>SUBJECT NAME</th>
                                    <th>TOTAL PERIODS</th>
                                    <th>PERIODS ATTENDED</th>
                                    <th>PERCENTAGE</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            <?php 
                                $conn = mysqli_connect("localhost","root","","attendence");

                                if(isset($_GET['from_date']) && isset($_GET['to_date']))
                                {
                                    $from_date = $_GET['from_date'];
                                    $to_date = $_GET['to_date'];
                                    $query = "SELECT sub_name , sum(total_periods) as tp, sum(periods_attended) as pa , sum(periods_attended)/sum(total_periods) * 100 as 'percentage' FROM student_records  WHERE date BETWEEN '$from_date' AND '$to_date' and student_id ='".($_SESSION['user1'])."' group by sub_name";
                                  /*  $query = "SELECT sub_name , sum(total_periods) FROM student_records  WHERE date BETWEEN '$from_date' AND '$to_date' and student_id = '" .($_SESSION['user1']) ."'";*/
                                    $query_run = mysqli_query($connect, $query);


                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $row)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $row['sub_name']; ?></td>
                                                <td><?= $row['tp']; ?></td>
                                                <td><?= $row['pa']; ?></td>
                                                <td><?= $row['percentage']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "No Record Found";
                                    }
                                }
                            ?>
                            </tbody>
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