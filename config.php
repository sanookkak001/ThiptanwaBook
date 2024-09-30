<?php 
$hostname = "localhost";
$username = "root";
$password = "12345678";
$dbname = "thiptanwa";
$conn = mysqli_connect("$hostname","$username","$password","$dbname");
date_default_timezone_set("Asia/Bangkok");		
mysqli_set_charset($conn,"utf8");
?>