<?php

include 'database_connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve and sanitize the data from the form
  $productId = $_POST['editProductId'];
  $productName = mysqli_real_escape_string($conn, $_POST['editProductName']);
  $productDescription = mysqli_real_escape_string($conn, $_POST['editProductDescription']);
  $productPrice = $_POST['editProductPrice'];
  $productCategory = mysqli_real_escape_string($conn, $_POST['editProductCategory']);
  $product_quantity = $_POST['editProductQuantity'];

  // Check if a new image file has been selected
  if ($_FILES["editProductImageFile"]["error"] == 0) {
    // Retrieve the old image filename from the database
    $sql = "SELECT P_Image FROM produts WHERE P_ID = '$productId'";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
      $oldImageFilename = $row['P_Image'];
      // Delete the old image from the "images" folder
      $oldImageFilePath = "images/" . $oldImageFilename;
      if (file_exists($oldImageFilePath)) {
        unlink($oldImageFilePath);
      }
    }

    // Upload the new image
    $target_dir = "images/";
    $filename = basename($_FILES["editProductImageFile"]["name"]);
    $target_file = $target_dir . $filename;

    if (move_uploaded_file($_FILES["editProductImageFile"]["tmp_name"], $target_file)) {
      // Update the database with the new image filename
      $sql = "UPDATE produts SET
          P_Name = '$productName',
          P_Description = '$productDescription',
          P_Price = '$productPrice',
          P_Category_Type = '$productCategory',
          P_Image ='$filename'
          WHERE P_ID = '$productId'";

      if (mysqli_query($conn, $sql)) {
        echo 'Product updated successfully!';
      } else {
        echo 'Error updating product: ' . mysqli_error($conn);
      }
    } else {
      echo 'Error uploading image.';
    }
  } else {
    // Update the database without changing the image
    $sql = "UPDATE produts SET
          P_Name = '$productName',
          P_Description = '$productDescription',
          P_Price = '$productPrice',
          P_Category_Type = '$productCategory',
          Prod_qty = '$product_quantity'
          WHERE P_ID = '$productId'";

    if (mysqli_query($conn, $sql)) {
      echo 'Product updated successfully!';
    } else {
      echo 'Error updating product: ' . mysqli_error($conn);
    }
  }
} 
// ... (rest of your code)



$query = "SELECT * FROM produts"; 
$result = mysqli_query($conn, $query);
$pageTitle = "Edit Products";
$content = 'edit_P_Content.php';
include 'Master.php';
?>
