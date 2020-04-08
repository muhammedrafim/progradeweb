<?php
$servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "prograde";
 $ser_key = "kanjw786cneu88734g4gb38yh4";
 
 // Create connection
 $conn = mysqli_connect($servername,$username,$password,$dbname);
 
 $base = "http://127.0.0.1/prograde/";
 // Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 //echo "Connected successfully";
 ?>