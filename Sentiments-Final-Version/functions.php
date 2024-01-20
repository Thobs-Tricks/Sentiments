<?php
include 'database_connection.php'; // Include the database connection file
session_start();

// Function to check if user is logged in
function isUserLoggedIn() {
    return isset($_SESSION['email']);
}

// Function to logout user
function logoutUser() {
    unset($_SESSION['email']);
    session_destroy();
}

// Function to authenticate and fetch user data
function authenticateUser($email, $password) {
    global $conn;

    // Perform user authentication
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }

    // User not found or invalid credentials
    return false;
}
?>

