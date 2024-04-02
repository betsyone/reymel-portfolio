<?php
// Database configuration
$dbHost = 'localhost'; // Change this if your database is hosted elsewhere
$dbUsername = 'root';   
$dbPassword = '';       
$dbName = 'user_authentication';

// Create database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
