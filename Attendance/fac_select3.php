<?php
@session_start();
include 'head.php';
include "bs.html";
//css file
echo "<link rel='stylesheet' type='text/css' href='css.css' />";

$username=$_SESSION['user'];
include "db_connect.php";
$query ="SELECT a.subject,a.regulation,a.year,a.sem,a.branch,a.br_code from fac_course a 
                                                                       inner join fac_login b on a.fname = b.fname 
                                                                       where b.fname = '$username'";
$result = $conn->query($query);
if($result->num_rows>0){
  $options=mysqli_fetch_all($result,MYSQLI_ASSOC);
}
?>
<html>
<body>
<div class="login_box">
<form action="getattendbyid.php" method="POST">
<label for="facultyname">select subject</label>
<select name="subject">
  <option name="Select Subject">Select Subject</option>
  <?php 
 foreach($options as $option){
  ?>
  <option value="<?php echo $option['subject']."-".$option['branch']."-".$option['year']."-".$option['sem']."-".$option['regulation']."-".$option['br_code'];  ?>"><?php echo $option['subject']."-".$option['branch']."-".$option['year']."-".$option['sem']."-".$option['regulation']."-".$option['br_code']; ?></option>
  <?php
  }
 ?>
</select>
<label> Enter Adm.no:</label><br>
<input type='text' name="adm_no" PlaceHolder='admission no.'>
<input type="submit" value="submit">
</form>
</div>
</body>
</html>