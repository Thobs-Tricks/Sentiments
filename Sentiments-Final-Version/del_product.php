<?php

include 'database_connection.php';
// Check if the product ID is provided via GET request
if (isset($_GET['product_id'])) {
    // Retrieve the product ID from the GET request
    $product_id = $_GET['product_id'];

    // SQL query to get the image filename associated with the product
    $sql = "SELECT P_Image FROM produts WHERE P_ID = ?";
    
    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Bind the product ID as a parameter
    $stmt->bind_param("s", $product_id);

    // Execute the statement
    $stmt->execute();

    // Bind the result
    $stmt->bind_result($imageFileName);

    // Fetch the result
    if ($stmt->fetch()) {
        // Product exists, retrieve the image filename
        $stmt->close();

        // Delete the product record from the database
        $deleteSql = "DELETE FROM produts WHERE P_ID = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("s", $product_id);

        // Delete the image from the "images" folder
        $imageFilePath = 'images/' . $imageFileName;
        if (unlink($imageFilePath) && $deleteStmt->execute()) {
            // Product deletion successful, including image deletion
            // Redirect to the product list page or display a success message
            header("Location: edit_products.php"); // Replace with your product list page URL
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
        echo "Product not found.";
    }
} else {
    // Product ID is not provided in the GET request
    // Handle the error or redirect as needed
    echo "Product ID not provided.";
}
?>

