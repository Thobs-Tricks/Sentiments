<?php
// include 'database_connection.php'; // Include the database connection file
// $newPass = false;
// $errorMsg = "";

// if (isset($_POST['submit'])) 
// {
//     $password = $_POST['psw'];
//     $cpassword = $_POST['psw-repeat'];

//     // Check if passwords match
//     if ($password != $cpassword) {
//         echo "Passwords do not match.";
//         exit();
//     }

//     // Hash the password
//     $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

//     // Prepare and execute the SQL statement
//     $sql = "UPDATE user SET (Password) = ($hashedPassword) WHERE Email='$email'";
//     $stmt = $conn->prepare($sql);

//     // Check if the statement was prepared successfully
//     if ($stmt === false) {
//         echo "Error in preparing statement: " . $conn->error;
//     } else {
//         // Bind parameters
//         $stmt->bind_param("s", $hashedPassword);

//         // Execute the statement
//         if ($stmt->execute()) {
//             header("Location: index.php?newPass=true");
//             echo 'You can now login';
//             exit(); 
//         } else {
//             echo "Error: " . $stmt->error;
//         }

//         // Close the statement
//         $stmt->close();
//     }
// }

// // Close the database connection
// $conn->close();
?>
