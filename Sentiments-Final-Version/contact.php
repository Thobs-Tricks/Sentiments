<?php

include 'database_connection.php';


$query = "SELECT * FROM contactus"; 
$result = mysqli_query($conn, $query);

$pageTitle = "Contact";
$content = 'contact_content.php';
include 'master.php';
?>