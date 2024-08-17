<?php
session_start();
include 'head.php';
include 'bs.html';
// $subdata=$_POST['subject'];
// $splitdata=preg_split("/[-]+/",$subdata);
// //print_r($splitdata);
// $_SESSION['subc']=$splitdata[0];
// $_SESSION['brac']=$splitdata[1];
// $_SESSION['yearc']=$splitdata[2];
// $_SESSION['semc']=$splitdata[3];
// $_SESSION['regc']=$splitdata[4];
// $_SESSION['br_code']=$splitdata[5];
//print_r($_POST);
 $user = $_SESSION['user'];
//  echo $_SESSION['privilege'];
?>
<html>
        <head>
                <style>
                        /* Navbar container */
                        .navbar {
                        overflow: hidden;
                        background-color: lightgrey;
                        font-family: Arial;
                        }

                        /* Links inside the navbar */
                        .navbar a {
                        float: left;
                        font-size: 16px;
                        color: black;
                        text-align: center;
                        padding: 14px 16px;
                        text-decoration: none;
                        border-radius:10px;
                        }
                        .logout a:hover{
                                float:right;
                                background-color: #002699;
                        }
                        .logout {
                                float:right;
                        }

                        /* The side navigation menu */
                        .sidenav {
                        height: 100%; /* 100% Full-height */
                        width: 0; /* 0 width - change this with JavaScript */
                        position: fixed; /* Stay in place */
                        z-index: 1; /* Stay on top */
                        top: 0;
                        left: 0;
                        background-color: Black; /* Black*/
                        overflow-x: hidden; /* Disable horizontal scroll */
                        padding-top: 60px; /* Place content 60px from the top */
                        transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
                        position : absolute;
                        top:210px;
                        }

                        /* The navigation menu links */
                        .sidenav a {
                        padding: 8px 8px 8px 32px;
                        text-decoration: none;
                        font-size: 25px;
                        color: white;
                        display: block;
                        transition: 0.3s;
                        }

                        /* When you mouse over the navigation links, change their color */
                        .sidenav a:hover {
                        color: blue;
                        }

                        /* Position and style the close button (top right corner) */
                        .sidenav .closebtn {
                        position: absolute;
                        top: 0;
                        right: 25px;
                        font-size: 36px;
                        margin-left: 50px;
                        }

                        /* Style page content - use this if you want to push the page content to the right when you open the side navigation */
                        #main {
                        transition: margin-left .5s;
                        padding: 20px;
                        }

                        /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
                        @media screen and (max-height: 450px) {
                        .sidenav {padding-top: 15px;}
                        .sidenav a {font-size: 18px;}
                        }
                        /* sidebar button */
                        button{
                                background-color: #00134d;
                                color: white;
                                padding: 8px 20px;
                                margin: 10px 0;
                                border: none;
                                cursor: pointer;
                                width: 10%;
                                border-radius:10px;
                        }
                </style>
                <script>
                        /* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
                        function openNav() {
                        document.getElementById("mySidenav").style.width = "250px";
                        document.getElementById("main").style.marginLeft = "250px";
                        }

                        /* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
                        function closeNav() {
                        document.getElementById("mySidenav").style.width = "0";
                        document.getElementById("main").style.marginLeft = "0";
                        }
                </script>
        </head>
        <body>
        <?php $menu_id = 1;?>
                <div class="navbar">
                        <a href=""><b>ONLINE ATTENDANCE MANAGEMENT SYSTEM</b></a>
                        <span class = "logout"><a href="faculty.php" class="glyphicon glyphicon-log-out" >Logout</a></span>
                </div>
                <div>
                        <div id="mySidenav" class="sidenav">
                                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                                <a href="fac_select1.php">Mark your Attendence</a>
                                <a href="fac_select2.php" >View Attendence by Date</a>
                                <a href="fac_select3.php" >View Attendence by Student Id</a>
                                <a href="change_pass.php" class="glyphicon glyphicon-edit">Change Password</a>
                        </div>
                        <!-- Use any element to open the sidenav -->
                        <div align = "center">
                                <h3>Welcome <b><?php echo $user;?></b></h3>
                                <button onclick="openNav()" >Click Here >> </button>
                        </div>
                </div>
        </body>
</html>