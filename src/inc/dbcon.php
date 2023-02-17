<?php
$host = "db";
$username = "root";
$password = "root";
$dbname = "db";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("connection failed" . mysqli_connect_error());
} 

?>