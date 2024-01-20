<?php
// remove_from_cart.php
include 'database_connection.php'; // Include the database connection file
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['productId'];

    if (isset($_SESSION['cart']) && in_array($productId, $_SESSION['cart'])) {
        $key = array_search($productId, $_SESSION['cart']);
        unset($_SESSION['cart'][$key]);
    }

    echo "Item removed from cart";
}
?>
