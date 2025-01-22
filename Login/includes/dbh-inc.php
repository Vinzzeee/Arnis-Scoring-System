<?php

$server = "localhost";
$username = "root";
$password = "mysql";
$db = "loginsignup";

// Connect to the database
$conn = mysqli_connect($server, $username, $password, $db);

// Check if the connection was successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>