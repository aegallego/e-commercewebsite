<?php

$host = 'localhost';
$user_name = 'root';
$user_password = '';
$db_name = "shop_db";

$conn = new mysqli($host, $user_name, $user_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  //echo "Connected successfully";
?>