<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = intval($_POST['quantity']);

    if (isset($_SESSION['cart'][$product_id])) {
        if ($quantity > 0) {
            // Update the quantity in the cart
            $_SESSION['cart'][$product_id]['quantity'] = $quantity;
        } else {
            // Remove the item from the cart if quantity is 0 or less
            unset($_SESSION['cart'][$product_id]);
        }
    }

    if (isset($_POST['remove_item'])) {
        $remove_product_id = $_POST['remove_item'];
        unset($_SESSION['cart'][$remove_product_id]);
    }
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
echo json_encode($response);
header("Location: cart.php");
exit();
?>