<?php
include 'database_connection.php';
$query = "SELECT P_Image, P_Name, P_Price FROM produts WHERE P_ID IN (1,3,4,5,12,9,8,16,7)";
$result = mysqli_query($conn, $query);
if (isset($_GET['registration_success']) && $_GET['registration_success'] === 'true') {
    echo '<script>
        $(document).ready(function() {
            $("#loginModal").modal("show");
        });
    </script>';
}
$pageTitle = "index";
$content = 'index_content.php';
include 'master.php';
?>