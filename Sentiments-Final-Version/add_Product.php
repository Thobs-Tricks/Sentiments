<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_name = $_POST["product_name"];
    $product_description = $_POST["product_description"];
    $product_price = $_POST["product_price"];
    $product_quantity = $_POST["product_quantity"];
    $product_category = $_POST["product_category"];
    
    // Upload image
    $target_dir = "images/";
    $filename = basename($_FILES["product_image"]["name"]);
    $target_file = $target_dir . $filename;
    
    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
       
      include 'database_connection.php';
        
        // SQL query to insert product data into the database
        $sql = "INSERT INTO produts (P_Name, P_Description, P_Price,  P_Category_Type, P_Image,Prod_qty) VALUES (?, ?, ?, ?, ?,?)";
        
        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);
        
        // Bind parameters to the statement
        $stmt->bind_param("ssssss", $product_name, $product_description, $product_price,$product_category, $filename,$product_quantity);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Product insertion successful
            // Redirect to the product list page or display a success message
            header("Location: edit_Products.php"); // Replace with your product list page URL
            exit();
        } else {
            // Product insertion failed
            // Handle the error as needed
            echo "Error: " . $stmt->error;
        }
        
        // Close the statement and database connection
        $stmt->close();
       
    } else {
        // Image upload failed
        // Handle the error as needed
        echo "Error uploading image.";
    }
}
?>
