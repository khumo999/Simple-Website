<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname ="gboutletfinal";

///Step 1  create the connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

//Step 2 check if the is connection

if(!$conn){
    die("Connection failed :". mysqli_connect_error());
    
}

?>