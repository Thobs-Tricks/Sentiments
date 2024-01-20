<?php
include 'database_connection.php'; // Include the database connection file

// Check if email field is set in the $_POST array
if(isset($_POST['submit'])) {

    $b4Email = $_POST['email'];
    // Sanitize user input
    $email = mysqli_real_escape_string($conn, $b4Email);

    $query = "SELECT * FROM `user` WHERE Email='$email'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $rows = mysqli_num_rows($result);

    if ($rows == 1) 
    {
        $encodedEmail = urlencode($email);

        // Create the redirect URL with the email parameter
        $redirectUrl = "newPass.php?email=$encodedEmail";

        // Perform the redirect
        header("Location: $redirectUrl");

        exit();
        
    } else 
    {
        // User not found
        echo "User not found.";
    }
} 
$conn->close();
?>

