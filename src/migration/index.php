<?php
$servername = "db";
$username = "root";
$password = "root";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "CREATE DATABASE db";
if (mysqli_query($conn, $sql)) {
  $data = [
    'status' => 200,
    'message' => 'Database created successfully'
  ];
  header("HTTP/1.0 200 OK");
  echo(json_encode($data));
} else {
  echo "Error creating database: " . mysqli_error($conn);
    $data = [
    'status' => 500,
    'message' => 'Error Creating Database'
    ];  
      header("HTTP/1.0 500 Error");
      echo(json_encode($data));
}

mysqli_close($conn);
?>