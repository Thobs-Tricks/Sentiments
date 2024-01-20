<?php
include 'database_connection.php';
$islogged = false;
if (isset($_SESSION['id'])) {
    $loggedInUserId = $_SESSION['id'];
    $islogged = true;
} else {
   
    $loggedInUserId = -1;
    $isloged = false;
}
$pageTitle = "Testimonial";
$content = 'testimonial_content.php';
include 'master.php';
?>
