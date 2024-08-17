<?php
include "head.php";
include "bs.html";
echo "<link rel='stylesheet' type='text/css' href='css.css' />";
?>
<html>
<head>

<style>
label{
text-align:left;

}
</style>

</head>
<body >
<div>

<!--  <?php
if(isset($_POST['adminlogin'])){
$adname=$_POST['adminname'];
$adpass=$_POST['adminpass'];
echo $adname;
echo $adpass;
}
else{
echo "you are failed";
}
?>  -->

</div>

<br><br>
<table align="center">
<tr>
<td>
<form onclick="C:\xampp\htdocs\php_workspace\new.php" method="post" align="center">
<div class="container" >
<h3>ADMIN LOGIN</h3>
<label  for="adminname">admin name</label>
<br>
<input type="text" name="adminname">
<br>
<label for="password">password</label>
<br>
<input type="password" name="adminpass">
<br><br>
<input type="submit" name="adminlogin">

</div>

</form>
</td>
</tr>
</table>

</body>

</html>