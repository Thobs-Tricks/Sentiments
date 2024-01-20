<?php
session_start();
?>

<html>
<head>
    <title>Shopping Cart</title>
</head>
<body>
<h1>Your Shopping Cart</h1>

<?php
$total_items = 0; // Initialize the total number of products to 0
$total_price = 0; // Initialize the total price to 0
$vat_rate = 0.15; // Set VAT rate to 15%
$delivery_fee = 100; // Fixed delivery fee

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product_id => $item) {
        $product_name = $item['product_name'];
        $product_price = $item['product_price'];
        $quantity = $item['quantity'];
        $item_total_price = $product_price * $quantity;

        $total_items += $quantity; // Update the total number of products
        $total_price += $item_total_price; // Update the total price

        echo "<div>";
        echo "<p>Product: $product_name, Price: $product_price</p>";
        echo "<form action='update_cart.php' method='post'>";
        echo "<input type='hidden' name='product_id' value='$product_id'>";
        echo "Quantity: <input type='number' name='quantity' value='$quantity' min='0'>";
        echo "<input type='submit' value='Update'>";
        echo "<button type='submit' name='remove_item' value='$product_id'>Remove</button>";
        echo "<p>Total Price: R$item_total_price</p>";
        echo "</form>";
        echo "</div>";
    }

    $subtotal = round($total_price / (1 + $vat_rate), 2); // Calculate the subtotal (excluding VAT) and round to 2 decimal places
    $vat_amount = round($total_price - $subtotal, 2); // Calculate the VAT amount and round to 2 decimal places

    

    // Check if the total order value is greater than R500 for free delivery
    if ($total_price > 500) {
        $delivery_fee = 0; // Free delivery if the total is greater than R500
    }
    // Calculate the total with delivery fee
    $_SESSION['delivery_fee'] = $delivery_fee;
    $total_with_delivery_fee = $total_price + $delivery_fee;

    echo "<div>";
    echo "<p>Total Items in Cart: $total_items</p>";
    echo "<p>Subtotal (Excluding VAT): R$subtotal</p>";
    echo "<p>VAT (Value Added Tax): R$vat_amount</p>";
    echo "<p>Delivery Fee: R$delivery_fee</p>";
    echo "<p>Total (Including VAT and Delivery Fee): R$total_with_delivery_fee</p>";

    // Coupon Code Section
    echo "<form method='post'>";
    echo "<label for='coupon_code'>Coupon Code:</label>";
    echo "<input type='text' name='coupon_code' id='coupon_code'>";
    echo "<input type='submit' name='apply_coupon' value='Apply Coupon'>";
    echo "</form>";

    if (isset($_POST['apply_coupon'])) {
        $entered_coupon = strtoupper($_POST['coupon_code']); // Convert to uppercase for case-insensitivity

        $coupons = [
            "SAVE10" => 0.10,     // 10% discount
            "FREESHIP" => 0.00,   // Free shipping
            // Add more coupons as needed
        ];

        if (isset($coupons[$entered_coupon])) {
            $discount = $coupons[$entered_coupon];
            $total_with_delivery_fee = $total_with_delivery_fee * (1 - $discount); // Apply the discount
            echo "<p>Discount Applied: " . ($discount * 100) . "%</p>";
            $_SESSION['discount'] = $discount * 100;
        }
    }

    echo "<p>Total Price(After Discount: R$total_with_delivery_fee</p>";
    echo "<form action='b.php' method='post'>";
echo "<input type='hidden' name='cart_data' value='" . htmlentities(json_encode($_SESSION['cart'])) . "'>";
echo "<input type='hidden' name='discount' value='" . $_SESSION['discount'] . "'>"; // Include the discount value
echo "<input type='hidden' name='delivery_fee' value='" . $_SESSION['delivery_fee'] . "'>"; // Include the discount value
echo "<input type='submit' value='Checkout'>";
echo "</form>";

    echo "</div>";
} else {
    echo "<p>Your cart is empty.</p>";
}
?>

<a href="shop.php">Continue Shopping</a>
</body>
</html>
