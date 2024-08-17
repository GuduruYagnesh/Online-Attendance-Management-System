<?php
@session_start();
include 'title.php';
include 'head.php';
include 'bs.html';
//css file
echo "<link rel='stylesheet' type='text/css' href='css.css' />";

$username=$_SESSION['user'];
$branch=$_SESSION['branch'];
$br_code=$_SESSION['br_code'];
include "db_connect.php";
$query1 ="SELECT distinct regulation from fac_course where branch = '$branch'";
$result1 = $conn->query($query1);
if($result1->num_rows>0){
  $options1=mysqli_fetch_all($result1,MYSQLI_ASSOC);
}
$query2 ="SELECT distinct year from fac_course where branch = '$branch'";
$result2 = $conn->query($query2);
if($result2->num_rows>0){
  $options2=mysqli_fetch_all($result2,MYSQLI_ASSOC);
}
$query3 ="SELECT distinct sem from fac_course where branch = '$branch'";
$result3 = $conn->query($query3);
if($result3->num_rows>0){
  $options3=mysqli_fetch_all($result3,MYSQLI_ASSOC);
}
?>

<html>
  <head>
    <style>
      .login_box1 {
          width: 700px;
          padding: 10px 30px 20px 10px;
          border: 1px solid #BFBFBF;
          background-color: white;
          box-shadow: 10px 10px 10px #aaaaaa;
          border-radius:10px;
          position : absolute;
          left : 400px;
          top:200px;
      }
      .level1 select{
          width: 20%;
          padding: 10px 20px;
          margin: 8px 0;
          display: inline-block;
          border: 1px solid #ccc;
          box-sizing: border-box;
          border-radius:10px;
      }
      .level2 input[type=date] {
          width: 33.33%;
          padding: 10px 20px;
          margin: 8px 0;
          display: inline-block;
          border: 1px solid #ccc;
          box-sizing: border-box;
          border-radius:10px;
      }
      input[type=submit]{
          background-color: #00802b;
          color: white;
          padding: 8px 20px;
          margin: 10px 0;
          border: none;
          cursor: pointer;
          width: 30%;
          border-radius:10px;                    
      }
    </style>
  </head>
  <body>
    <div class="login_box1">
      <form method="POST" action="uphodview.php">
        <div class="level1">
          <label>Regulation:</label>
          <select name="reg" id="reg">
            <option value=" ">Regulation</option>
            <?php 
              foreach($options1 as $option){
            ?>
            <option value="<?php echo $option['regulation'];?>" ><?php echo $option['regulation'];?></option>
            <?php
              }
            ?>
          </select>
          <label>Year:</label>
          <select name="year" id="year" >
            <option value=" ">Year</option>
            <option value="I">I</option>
            <option value="II">II</option>
            <option value="III">III</option>
            <option value="IV">IV</option>
          </select>
          <label>Semester:</label>
          <select name="sem" id="sem">
            <option value=" ">Semester</option>
            <option value="I">I</option>
            <option value="II">II</option>
          </select>
        </div>
        <label>Subject:</label>
        <select name="subject" id="subject">
          <option value="">Subject</option>
        </select>
        <label>Faculty:</label>
        <select name="faculty" id="faculty">
          <option value="">Faculty</option>
        </select>
        <div class='level2'>
          <label>From Date:</label>
          <input type ="date" name="date1" id = "date1">
          <label>To Date:</label>
          <input type ="date" name="date2" id = "date2">
        </div>
        <div align="center">
          <input type="submit">
        </div>
      </form>
    </div>
    <script>
      $(document).ready(function(){
        $('#sem').change(function(){
            var _reg = $("#reg").val();
            var _year = $("#year").val();
            var _sem = $("#sem").val();
            $.ajax({
                url:"ajaxsubject.php",
                method:"POST",
                data:{reg:_reg, year:_year, sem:_sem},
                dataType:"text",
                success:function(data){
                    $("#subject").html(data);
                }
            });
            $.ajax({
              url:"ajaxfaculty.php",
              method:"POST",
              data:{reg:_reg, year:_year, sem:_sem},
              dataType:"text",
              success:function(data){
                $("#faculty").html(data);
              }
            });
        });
      });
    </script>
    <div><br><br><br></div>
  </body>
</html>
<?php
?>