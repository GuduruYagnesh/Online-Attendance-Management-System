<?php
    session_start();
    include "head.php";
    include "bs.html";

    date_default_timezone_set("Asia/Kolkata");
    // validating the login details.
    if(!empty($_POST['hodname']) && !empty($_POST['hodpass'])){    
            $username = strtoupper($_POST['hodname']);
            $password = strtoupper($_POST['hodpass']);
            require("logindetails.php");
            $opt = new Operations();
            $res = $opt->checkHodLogin($username, $password);

                if($res['status'] == 'success' and $res['priv'] == 'hod'){
                    $_SESSION['user'] = $res['user'];
                    $_SESSION['branch']= $res['branch'];
                    $_SESSION['br_code']=$res['br_code'];
                    header('Location:check.php');
                                
                }else{
                    echo '<script type="text/javascript">
                            alert("Invalid Username or Password..!"); 
                            document.location.href ="hod.php";
                        </script>';
                }
    }
    else if(!empty($_POST['hodname']) && empty($_POST['hodpass'])){
    echo '<script type="text/javascript">
                            alert("please enter the required details"); 
                            document.location.href ="hod.php";
                        </script>';
    }
?>
<html>
    <head>
        <link rel='stylesheet' type='text/css' href='css.css' />
    </head>
    <body>
        <div class="login_box">
            <form onclick="check.php" method="post">
                <div class="form" >
                    <h3 align = "center"><b><u>HOD LOGIN</u></b></h3>
                    <label for="hodname">username:</label>
                    <input type="text" name="hodname" placeholder="Enter your username">
                    <label for="password">password:</label>
                    <input type="password" name="hodpass" placeholder="Enter your password">
                    <div align ="center">
                        <input type="submit" name="hodlogin">
                    </div>
                </div>
            </form>
            <span class="psw"><a href="#"><u>Forgot password?</u></a></span>
        </div>
    </body>
</html>