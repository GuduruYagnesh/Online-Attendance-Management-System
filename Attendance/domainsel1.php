<?php
    include "head.php";
    include "bs.html";
    //css file
    // echo "<link rel='stylesheet' type='text/css' href='css.css' />";
?>
<html>
    <head>
        <style>
            body {
                margin: 0;
                font-family: Arial, Helvetica, sans-serif;
            }
            .button{
                text-align:center;
                border:white;
                border-radius:5px;
                font-size:30px;
                box-shadow: 10px 10px 10px #aaaaaa;
                background-image: linear-gradient(to bottom right, lightblue,lightgrey);
            }
        </style>
    </head>
    <body>
        <br><br><br><br>
        <div align="center">
            <button onclick="location.href='domainsel.php'" type="button" class="button" >
                <b>Attendance login</b></button>
        </div>
        <br><br>
        <div align="center">
            <!--to disable the feedback login button..comment the below line of code.-->        
            <button onclick="location.href='../practice/feedback2/'" type="button" class="button"><b>Feedback Login</b></button>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><hr>
    </body>
</html>
<?php 
    include "footer.php";
?>
