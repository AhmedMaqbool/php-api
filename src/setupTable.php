<?php
$servername = "db";
$username = "root";
$password = "root";
$dbname = "db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// sql to create table
$sql = "CREATE TABLE schools (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(191) NOT NULL
)";


$sql1 = "CREATE TABLE students (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(191) NOT NULL,
school_id INT NOT NULL,
order_id INT NOT NULL
)";


if (mysqli_query($conn, $sql)) {
  echo "Table schools created successfully";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}

if (mysqli_query($conn, $sql1)) {
  echo "Table students created successfully";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>