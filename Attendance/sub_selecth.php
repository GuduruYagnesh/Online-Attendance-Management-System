<?php
@session_start();
include 'head.php';
include 'db_connectstu.php';
$username=$_SESSION['user'];
$branch=$_SESSION['branch'];
$querys= "SELECT distinct sub_name from student_records where branch ='$branch'";
$results = $connect->query($querys);
if($results->num_rows>0){
  $options=mysqli_fetch_all($results,MYSQLI_ASSOC);
} 
?>
<html>
    <head>
    <script>
function showUser(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","hup.php?q="+str,true);
    xmlhttp.send();
  }
}
</script>
    </head>
    <body>
        <br><br>
    <form align="center">
    <label>Select Subject :</label>
    <select name="subject1" onchange="showUser(this.value)">
        <option value=" "></option>
        <?php 
    foreach($options as $option){
  ?>
  <option value="<?php echo $option['sub_name'] ;?>" ><?php echo $option['sub_name'] ?></option>
  <?php
  }
 ?>
    </select>
    <div id="txtHint">hello..</div>
    </form>
    </body>
</html>