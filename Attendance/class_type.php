
<?php 
session_start();
   include "db_connect.php";
   $user=$_SESSION['user'];
   $country_id=$_POST['sub_id'];
   if(!empty($country_id) && $country_id=="regular"){

        $query ="SELECT a.subject,a.regulation,a.year,a.sem,a.branch,a.br_code from fac_course a 
                                                                            inner join fac_login b on a.fname = b.fname 
                                                                            where b.fname = '$user'";
        $result = $conn->query($query);
        if($result->num_rows>0){
        $options=mysqli_fetch_all($result,MYSQLI_ASSOC);
         
        }
        foreach($options as $option){
            echo '<option value="'. $option['subject'].'-'.$option['branch'].'-'.$option['year'].'-'.$option['sem'].'-'.$option['regulation'].'-'.$option['br_code'].'">'. $option['subject'].'-'.$option['branch'].'-'.$option['year'].'-'.$option['sem'].'-'.$option['regulation'].'</option>';
        }
   }
   else if(!empty($country_id) && $country_id=="open_elective"){
        $query ="SELECT ";
        $result = $conn->query($query);
        if($result->num_rows>0){
        $options=mysqli_fetch_all($result,MYSQLI_ASSOC);
         
        }
        foreach($options as $option){
            echo '<option value="' . $option[''] . '">' . $option[''] . '</option>';
        }
   }
?>
