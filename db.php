<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost"; // Change this to your MySQL server address
$username = "p869j343"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "p869j343"; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if($conn->connect_errno){
    die("Connection failed: " . $conn->connect_erro);
}

// Set charset to UTF-8 (optional, adjust based on your requirements)
$conn->set_charset("utf8");
?>