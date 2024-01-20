<?php
session_start();

if (isset($_POST['product_id']) && isset($_POST['product_name']) && isset($_POST['product_price'])
&& isset($_POST['product_image']) && isset($_POST['product_desc'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_desc = $_POST['product_desc'];

    $cart_item = [
        'product_id' => $product_id,
        'product_name' => $product_name,
        'product_price' => $product_price,
        'product_image' =>$product_image,
        'product_desc' =>$product_desc
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the product is already in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
        $cart_item['quantity'] = 1;
        $_SESSION['cart'][$product_id] = $cart_item;
    }
    // After adding the product to the cart, update the cart count
$_SESSION['cart_count'] = count($_SESSION['cart']);

// Return the updated cart count as a response
$response = array(
    'message' => 'Product added to cart.',
    'cartCount' => $_SESSION['cart_count']
);
echo json_encode($response);

   
    echo "Product added to cart.";

} else {
    echo "Invalid request.";
}
?>
