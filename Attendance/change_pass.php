<?php
    @session_start();
    include "bs.html";
    error_reporting(E_ERROR | E_PARSE);
    // echo $_SESSION['user'];
    // echo $_SESSION['privilege'];
    if(!empty($_SESSION['user'])){
        $username = $_SESSION['user'];
        require_once('head.php');

        if(!empty($_GET['currentpass']) && !empty($_GET['newpass']) && !empty($_GET['renewpass']))
        {
            // connection
            require("logindetails.php");
            $opt = new Operations();

            // changing password
            $currentpass = $_GET['currentpass'];
            $newpass = $_GET['newpass'];
            $renewpass = $_GET['renewpass'];
            $msg = $opt->changePassword($username, $currentpass, $newpass, $renewpass);
        }
    
?>
<html>
    <head>
        <style>
            .table{
                font-size : 18px;

            }
            th,td{
                text-align : center;
            }
            .btn {
                background-color: white;
                border: none;
                color: DodgerBlue;
                padding: 12px 16px;
                font-size: 16px;
                cursor: pointer;
            }
            .log{
                position : absolute;
                left : 1420px;
                top:150px;
            }
            </style>
    </head>
    <body>
    <div class="log">
  <button class="btn" onClick="window.location.href='fac_attend.php';"><i class="fa fa-home"></i>Home</button>
  </div>
    <br><br>
        <form method="GET"  align="center">
            <table align="center">
            <tr>
                <td colspan=2><h1>change your password</h1></td>
            </tr>
            <tr>
            <td><label><b>Current password</b></label></td>
            <td style="text-align : left;"><input type="password" name="currentpass" required><br><br></td>
            </tr>
            <tr>
            <td><label><b>New password</b></label></td>
            <td style="text-align : left;"><input type="password" name="newpass" required><br><br></td>
        </tr>
        <tr>
        <td><label><b>Confirm password</b></label></td>
        <td style="text-align : left;"><input type="password" name="renewpass" required><br><br></td>
            <br>
        <tr>
        <td colspan=2> <input type="submit"></td>
        </table>
    </form>
    <?php
                        if($msg=="pwd_chngd"){
                            echo '<div class="alert alert-success" role="alert"> password changed successfully!!</div>';
                        }
                        if($msg=="incorrect"){
                            echo '<div class="alert alert-danger" role="alert">Current password is incorrect!!</div>';
                        }	
                        if($msg=="pwd_mismatch"){
                            echo '<div class="alert alert-danger" role="alert">Re-Entered password is incorrect!!</div>';
                        }	
                    ?>
    </body>
    </html>
<?php 
       
    }
    // else{
    //     header('Location: fac_attend.php');
    // }
?>
