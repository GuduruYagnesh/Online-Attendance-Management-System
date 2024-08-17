<?php
    include "head.php";
    include "hcss.php";
?>
<html>
    <head>
        <style>
            body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            }

            .topnav {
            overflow: hidden;
            background-color: #333;
            }

            .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
            }

            .topnav a:hover {
            background-color: #ddd;
            color: black;
            }

            .topnav a.active {
            background-color: #04AA6D;
            color: white;
            }
            .button{
                text-align:center;
                border:white;
                border-radius:5px;
                font-size:20px;
                padding: 10px;
                font-family: "Prata", serif;
                box-shadow: 2px 2px 2px #aaaaaa;
                background-color: white;
            }
            .button:hover{
                background-color: #05004e;
                
                color: white;
            }
            .grid-container {
                display: grid;
                grid-template-columns: auto auto;
                gap: 1px;
                /* background-color: #2196F3; */
                padding: 130px;
            }

            .grid-container > div {
                /* background-color: rgba(255, 255, 255, 0.8); */
                text-align: center;
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <br><br><br><br><br>
        <div id="app">
            <div class="title">
                <div class="title-inner">
                    <div class="cafe">
                        <div class="cafe-inner">Online Attendance</div>
                    </div>
                    <div class="mozart">
                        <div class="mozart-inner">Management System</div>
                    </div>
                </div>
            </div>
            <div align ="center" class="grid-container">
                <div class = "a">
                    <button onclick="location.href='admin.php'" type="button" class="button" ><b>ADMIN LOGIN</b></button>
                </div>
                <div class = "h">
                    <button onclick="location.href='hod.php'" type="button" class="button" ><b>HOD LOGIN</b></button>
                </div>
                <div class = "f">
                    <button onclick="location.href='faculty.php'" type="button" class="button" ><b>FACULTY LOGIN</b></button>
                </div>
                <div class = "s">
                    <button onclick="location.href='studentthru.php'" type="button" class="button" ><b>STUDENT LOGIN</b></button>
                </div>
            </div>
        </div>
        <script src="https://codepen.io/shshaw/pen/QmZYMG.js"></script>

        <br><hr>
        <footer>
            <?php
                include "footer.php";
            ?>
        </footer>
    </body>
</html>
