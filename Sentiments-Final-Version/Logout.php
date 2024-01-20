<?php
require_once 'functions.php'; // Include the functions
include 'database_connection.php'; // Include the database connection file

logoutUser(); // Call the logout function

header("Location: index.php");
$conn->close();
exit();

?>