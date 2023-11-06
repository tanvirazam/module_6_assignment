<?php 
$hostname = "localhost";
$dbusername = "root";
$password = "";
$database = "real_life_business";

// connect database
$mysqli = new mysqli($hostname,$dbusername,$password,$database);

// check database connection
if (mysqli_connect_errno()){
    echo "Connection Faild <br> " . mysqli_connect_error();
}