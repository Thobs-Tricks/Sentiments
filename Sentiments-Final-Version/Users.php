<?php

include 'database_connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve and sanitize the data from the form
  $UserId = $_POST['editUserId'];
  $FirstName = mysqli_real_escape_string($conn, $_POST['editF_name']);
  $LastName = mysqli_real_escape_string($conn, $_POST['editL_name']);
  $U_Pass = mysqli_real_escape_string($conn, $_POST['editemail']);
  $U_Role = mysqli_real_escape_string($conn, $_POST['editrole']);
  $U_Address = mysqli_real_escape_string($conn, $_POST['editaddress']);
  $U_Phone = $_POST['editphone'];
  $U_Gender = mysqli_real_escape_string($conn, $_POST['editgender']);
  $U_dob = $_POST['editdob'];

  /*/ Check if a new image file has been selected
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
    }*/

    /*/ Upload the new image
    $target_dir = "images/";
    $filename = basename($_FILES["editProductImageFile"]["name"]);
    $target_file = $target_dir . $filename;*/

    /*if (move_uploaded_file($_FILES["editProductImageFile"]["tmp_name"], $target_file)) {
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
  } else {*/
    // Update the database without changing the image
    $sql = "UPDATE user SET
          F_Name = '$FirstName',
          L_Name = '$LastName',
          Password = '$U_Pass',
          role = '$U_Role',
          Address = '$U_Address',
          Phone = '$U_Phone',
          Gender = '$U_Gender',
          DOB = '$U_dob'
          WHERE id = '$UserId'";

    if (mysqli_query($conn, $sql)) {
      echo 'User updated successfully!';
    } else {
      echo 'Error updating User: ' . mysqli_error($conn);
    }
  
} 
// ... (rest of your code)*/}



$query = "SELECT * FROM user"; 
$result = mysqli_query($conn, $query);
$pageTitle = "User Management";
$content = 'Users_Content.php';
include 'Master.php';
?>
