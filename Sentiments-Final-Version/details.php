<?php
$product_id = $_GET['P_Name']; // Fetch the product_id from the URL

// Fetch product details based on the product_id
$query = "SELECT P_Name, P_Description, P_Price FROM produts";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $filename = $row['P_Name'];
    $description = $row['P_Description'];
    $price = $row['P_Price'];

    // Display detailed product information
    echo "<div>";
    echo "<img src='images/$filename' alt='$filename'>";
    echo "<h2>$filename</h2>";
    echo "<p>$description</p>";
    echo "<p>Price: $price</p>";
    echo "</div>";
} else {
    echo "Product not found.";
}
?>
