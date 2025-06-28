<?php
//error_reporting(0); it will remove error which display on browser 

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "registration_form";

    // To establish connection with database and html
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // For checking connection
    if($conn){
    //    echo "Connection established";
    }
    else{
        echo "Connection failed";
    }


?>