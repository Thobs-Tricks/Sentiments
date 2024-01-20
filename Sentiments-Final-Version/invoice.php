<?php
include 'database_connection.php'; 

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
$query = "SELECT * FROM invoice WHERE U_Id = $id" ; 
$result = mysqli_query($conn, $query);
}
$pageTitle = "Invoice";
$content = 'invoice_content.php';
include 'master.php'

?>