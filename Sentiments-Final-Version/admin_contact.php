<?php
include 'database_connection.php';


$query = "SELECT * FROM contactus"; 
$result = mysqli_query($conn, $query);

$pageTitle = "Requests";
$content = 'contact_admin.php';
include 'master.php';
?>