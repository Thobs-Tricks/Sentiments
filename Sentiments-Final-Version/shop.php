<?php
include 'database_connection.php';

// Get the selected category from the URL parameter
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : '';

// Build your SQL query to select products based on the category
$query = "SELECT * FROM produts"; // Replace "your_table_name" with your actual table name

// Check if a specific category is selected; if not, do nothing (display all)
if (!empty($selectedCategory) && $selectedCategory !== 'all') {
    $query .= " WHERE P_Category_Type = '$selectedCategory'";
}

// Execute the query to fetch products
$result = mysqli_query($conn, $query);

$pageTitle = "Shop";
$content = 'shop_content.php';
include 'master.php';
?>