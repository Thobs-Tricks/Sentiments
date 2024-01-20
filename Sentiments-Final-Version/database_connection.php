<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "User";
$password = "Password1";
$database = "sentiments";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
$pdo = new PDO("mysql:host=localhost;dbname=sentiments", "User", "Password1");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
