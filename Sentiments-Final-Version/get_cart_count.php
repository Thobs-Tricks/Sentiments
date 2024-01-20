<?php
session_start();

if (isset($_SESSION['cart_count'])) {
    $cartCount = $_SESSION['cart_count'];
} else {
    $cartCount = 0; // Default to 0 if not set
}

$total_quantity = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_quantity += $item['quantity'];
}

// Update the cart count in the session
$_SESSION['cart_count'] = $total_quantity;

// Return the updated cart count as part of the response
$response = array(
    'cartCount' => $_SESSION['cart_count']
);

header('Content-Type: application/json');
echo json_encode($response);
?>
