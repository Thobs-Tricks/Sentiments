<?php
include 'database_connection.php'; // Include the database connection file
$AdditionSuccess = false;
$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['F_name'];
    $lname = $_POST['L_name'];
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $cpassword = $_POST['psw-repeat'];
    $role = $_POST['role'];
    $Address = $_POST['address'];
    $phone = $_POST['phone'];
    $Gender = $_POST['gender'];
    $DOB = $_POST['dob'];

    // Check if passwords match
    if ($password != $cpassword) {
        echo "Passwords do not match.";
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO user (Email, F_Name, L_Name, Password, role, Address, Phone, Gender, DOB, registration_date, last_login) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        echo "Error in preparing statement: " . $conn->error;
    } else {
        // Bind parameters
        $stmt->bind_param("sssssssss", $email, $fname, $lname, $hashedPassword, $role, $Address, $phone, $Gender, $DOB);

        // Execute the statement
        if ($stmt->execute()) {
            echo '<script>alert("User added successfully");</script>';
            header("Location: Users.php?Addition_success=true");
            exit(); 
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>