<?php
include 'database_connection.php'; // Include the database connection file


// Check if email field is set in the $_POST array
if(isset($_POST['email'])) {
    // Sanitize user input
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $query = "SELECT * FROM `user` WHERE Email='$email'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $rows = mysqli_num_rows($result);

    if ($rows == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['Password'];
        $role = $row['role'];
        $id = $row['id'];


        // Compare hashed password
        if (password_verify($_POST['password'], $hashedPassword)) {
            // Password is correct, user is logged in
            // Your login success logic here
            session_start(); // Start the session if it's not already started
            $_SESSION['email'] = $email; // Set the email in the session
            $_SESSION['role'] = $role;
            $_SESSION['id'] = $id;
            header('Location: index.php');
           
            exit(); // Exit to prevent further execution
        } else {
            // Password is incorrect
            // Your login failure logic here
            echo "Incorrect email or password.";
            
        }
    } else {
        // User not found
        echo "User not found.";
    }
} 

$conn->close();
?>
