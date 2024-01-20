<?php

include 'database_connection.php';
// Check if the product ID is provided via GET request
if (isset($_GET['user_id'])) {
    // Retrieve the product ID from the GET request
    $user_id = $_GET['user_id'];

    // SQL query to get the image filename associated with the product
    $sql = "SELECT F_Name FROM user WHERE id = ?";
    
    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Bind the product ID as a parameter
    $stmt->bind_param("s", $user_id);

    // Execute the statement
    $stmt->execute();

    // Bind the result
    $stmt->bind_result($LName);

    // Fetch the result
    if ($stmt->fetch()) {
        // Product exists, retrieve the image filename
        $stmt->close();

        // Delete the product record from the database
        $deleteSql = "DELETE FROM user WHERE id = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("s", $user_id);

        // Delete the image from the "images" folder
        //$imageFilePath = 'images/' . $imageFileName;
        if ($deleteStmt->execute()) {
            // Product deletion successful, including image deletion
            // Redirect to the product list page or display a success message
            header("Location: Users.php"); // Replace with your product list page URL
            exit();
        } else {
            // Product deletion failed
            // Handle the error as needed
            echo "Error: " . $deleteStmt->error;
        }

        // Close the statement
        $deleteStmt->close();
    } else {
        // Product not found in the database
        echo "User not found.";
    }
} else {
    // Product ID is not provided in the GET request
    // Handle the error or redirect as needed
    echo "User ID not provided.";
}
?>

