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


if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql1)) {
    $data = [
        'status' => 200,
        'message' => 'Tables created successfully'
      ];
    header("HTTP/1.0 200 OK");
    echo(json_encode($data));
} else {
    $data = [
      'status' => 500,
      'message' => 'Tables not created successfully'
    ];
  header("HTTP/1.0 500 error");
  echo(json_encode($data));
}

mysqli_close($conn);
?>

