<?php
  session_start();
  include 'title.php';
  include 'bs.html';
  $subdata=$_POST['subject'];
  $splitdata=preg_split("/[-]+/",$subdata);
  //print_r($splitdata);
  $_SESSION['subc']=$splitdata[0];
  $_SESSION['brac']=$splitdata[1];
  $_SESSION['yearc']=$splitdata[2];
  $_SESSION['semc']=$splitdata[3];
  $_SESSION['regc']=$splitdata[4];
  $_SESSION['br_code']=$splitdata[5];
  $subat=$_SESSION['subc'];
  $branchat=$_SESSION['brac'];
  $usefac=$_SESSION['user'];
  $yearat=$_SESSION['yearc'];
  $semat=$_SESSION['semc'];
  $br_codeat=$_SESSION['br_code'];
  $regat=$_SESSION['regc'];
  include 'head.php';
  include 'db_connect.php';
  $query="SELECT sid,email FROM st_login WHERE regulation='$regat' and  year='$yearat' and br_code='$br_codeat' and sem='$semat' order by sid";
  $result=$conn->query($query);
  if($result->num_rows>0){
    $options=mysqli_fetch_all($result,MYSQLI_ASSOC);
  }

?>
<html>
  <head>
    <style>
      .table-hover{
              width:70%;
              align:center;
              }
               th,td{
                text-align : center;
              } 
              .kl{
                align:right;
              }
              .al{
                position : absolute;
                left : 1100px;
                top:300px;
              } 
      input[type=date]{
                width: 10%;
                padding: 10px 10px;
                margin: 1px 0;
                display: inline-block;
                border: 1px solid #ccc;
                box-sizing: border-box;
                border-radius:10px;
      } 
      select {
                width: 3%;
                padding: 10px 10px;
                margin: 1px 0;
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
                width: 10%;
                border-radius:10px;                    
            }
    </style> 
    <script type="text/javascript">
        function selectAll(form1) {
          
          var check = document.getElementsByName("group4"),
              radios = document.form1.elements;
          if (check[0].checked) {
          
            for( i = 0; i < radios.length; i++ ) {
              
              //And the elements are radios
              if( radios[i].type == "radio" ) {
                
                //And the radio elements's value are 1
                if (radios[i].value == 1 ) {
                  //Check all radio elements with value = 1
                  radios[i].checked = true;
                }
                
              }//if
              
            }//for
            
          //If the second radio is checked
          } else {
            
            for( i = 0; i < radios.length; i++ ) {
              
              //And the elements are radios
              if( radios[i].type == "radio" ) {
                
                //And the radio elements's value are 0
                if (radios[i].value == 0 ) {
          
                  //Check all radio elements with value = 0
                  radios[i].checked = true;
          
                }
                
              }//if
              
            }//for
            
          };//if
          return null;
        }
    </script>
  </head>
  <body>
  <?php if($result->num_rows>0)
  {
    ?>
    <br>
    <h4 align="center"><b>Subject&nbsp;:&nbsp;</b><?php echo $subat;?></h4>
    <br>
    <form action="fac_sub.php" align="center" method="POST" name='form1'>
        <label for="date selection">Date:</label>
        <input type="date" id="class_date" name="class_date">
        <label for="Starting Seriod">Starting Period:</label>
        <select name="Starting_Period"  required>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
        </select>
        <label for="Total_Periods">Total Periods</label>
          <select name="Total_Periods" required>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select>
          <br><br>
        <br>
        <div class="al">
          <input type="radio" name="group4" value="1" onclick="selectAll(form1)">All present &nbsp;<b>||</b>
          <input type="radio" name="group4" value="0" onclick="selectAll(form1)" >All absent<br />
        </div>
        <table align="center" class="table table-hover">
            <tr>
            <th>S.no</th>
            <th>Adm.no</th>
            <th style="text-align:left;">Name</th>
            <th>Attendence</th>
            </tr>
            <?php
            $sn=1;
            foreach($options as $option)
            {
            ?>
            <tr>
            <td><?PHP echo $sn; ?></td>
            <td><?php echo $option['sid']; ?></td>
            <td style="text-align:left;"><?php echo $option['email']; ?></td>

            <td>
            <input type='radio' required="required" class="chk" name='<?php echo $option['sid'];?>' value=1 >
            <label>present</label>&nbsp;
            <input type='radio' required="required" class="chk1" name='<?php echo $option['sid'];?>' value=0 ><label>absent</label>
            </td>
            </tr>
            <?php $sn++;
            }
            ?>
        </table>
        <br>
        <input type="submit" name="submit" value="submit">
    </form>
    <?php 
  }
  else{
    echo '<script type="text/javascript">
    alert("please select a valid subject"); 
    document.location.href ="fac_select1.php";
</script>';
    
   }
  ?>
  </body>
</html>