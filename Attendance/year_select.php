<?php
@session_start();
include 'db_connect.php';
$q = intval($_GET['q']);
$query2 ="SELECT distinct year from fac_course where regulation = '".$q."'";
$result2 = $conn->query($query2);
if($result2->num_rows>0){
    $options2=mysqli_fetch_all($result2,MYSQLI_ASSOC);
    } 
?>
<html>
<head>
<style>
label{
text-align:left;

}

</style>
<script>
function User1(str1) {
  if (str1 == "") {
    document.getElementById("txtHint1").innerHTML = "";
    return;
  } else {
    var xmlhttp1 = new XMLHttpRequest();
    xmlhttp1.onreadystatechange = function() {
      if (this.readyState == 4) {
        document.getElementById("txtHint1").innerHTML = this.responseText1;
      }
    };
    xmlhttp1.open("GET","sem_select.php?r="+str1,true);
    xmlhttp1.send();
  }
}
</script>
</head>
<body>
<br><br>
<form align="center"> 
    <label>Year :</label>
    <select name="year1" onchange="User1(this.value)">
        <option value=" ">Year</option>
        <?php 
  foreach($options2 as $option){
  ?>
  <option value="<?php echo $option['year'] ?>" ><?php echo $option['year'] ?></option>
  <?php
  }
 ?>
    </select>
    <div id="txtHint1"><b>select year.........</b></div>
    </form>
</body>
</html>
<?php 
// $r = intval($_GET['r']);
// echo $r;
?>