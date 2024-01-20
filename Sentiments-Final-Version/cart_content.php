<div class="cart-container">
    
    <?php
    include 'database_connection.php';

?>

<html>
<head>
    <title>Shopping Cart</title>
    <style>
        table {
        
          
            border-collapse: collapse;
            background-color: white; /* Set the table background to white */
        }
        

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 100px;
            vertical-align: middle;
        }

        .product-info {
            display: flex;
            align-items: center;
        }

        .btn-remove{
            background-color: red;    
        }
        .btn-add{
            background-color: #60fa65;
        }
        .checkout-button {
    background-color: #6610f2;
    color: #fff;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    
}
    </style>
</head>
<body>
    <div style=" padding: 10px;">
<h1>Your Shopping Cart</h1>
<hr>
<?php
$total_items = 0; 
$total_price = 0; 
$vat_rate = 0.15;
$delivery_fee = 100; 
$item_total_price =0.0;


if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    echo '<table>';
    echo '<tr>';
    echo '<th>Image</th>';
    echo '<th>Product Name</th>';
    echo '<th>Price</th>';
    echo '<th>Quantity</th>';
    echo '<th>Total Price</th>';
    echo '<th>Actions</th>';
    echo '</tr>';

    foreach ($_SESSION['cart'] as $product_id => $item) {
        $product_name = $item['product_name'];
        $product_image = $item['product_image'];
        $product_price = $item['product_price'];
       
        $quantity = $item['quantity'];
        $item_total_price = (float)$product_price * $quantity;
    
        $total_items += $quantity;
        $total_price += $item_total_price;
    
        echo '<tr>';
        echo '<td><img src="images/' . $product_image . '" alt="' . $product_name . '"></td>';
        echo '<td><b>' . $product_name . '</b></td>';
        echo '<td>R' . $product_price . '</td>';
        echo '<td>';
        echo "<form action='update_cart.php' method='post'>";
        echo "<input type='hidden' name='product_id' value='$product_id'>";
        echo '<input type="number" name="quantity" value="' . $quantity . '" min="0">';
        echo '</td>';
        echo '<td>';
        echo "R" . $item_total_price;
        echo '</td>';
        echo '<td>';
        echo "<button class='btn-remove' type='submit' name='remove_item' value='" . $product_id . "'>Remove</button>";
        echo '<input class="btn-add" type="submit" value="Update">';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
    }

    
    $subtotal = round($total_price / (1 + $vat_rate), 2); // Calculate the subtotal (excluding VAT) and round to 2 decimal places
    $vat_amount = round($total_price - $subtotal, 2); // Calculate the VAT amount and round to 2 decimal places

    echo '</table>';

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
    echo "<input type='submit' name='apply_coupon' value='Apply Coupon'   style='background-color:#db4f66; padding: 10px 20px; border: none; cursor: pointer;'>";
    echo "</form>";

    if (isset($_POST['apply_coupon'])) {
        $entered_coupon = strtoupper($_POST['coupon_code']); // Convert to uppercase for case-insensitivity

        $coupons = [
            "SAVE10" => 0.10,     // 10% discount
            "SAVE50" => 0.50,   // Free shipping
            // Add more coupons as needed
        ];

        if (isset($coupons[$entered_coupon])) {
            $discount = $coupons[$entered_coupon];
            $total_with_delivery_fee = $total_with_delivery_fee * (1 - $discount); // Apply the discount
            echo "<p>Discount Applied: " . ($discount * 100) . "%</p>";
            $_SESSION['discount'] = $discount * 100;
        }
    }
    else
    {
        $_SESSION['discount'] =0;

    }

    echo "<p>Total Price(After Discount: R$total_with_delivery_fee)</p>";
    echo "<form action='checkout.php' method='post'>";
    echo "<input type='hidden' name='cart_data' value='" . htmlentities(json_encode($_SESSION['cart'])) . "'>";
    echo "<input type='hidden' name='discount' value='" . $_SESSION['discount'] . "'>";
    echo "<input type='hidden' name='delivery_fee' value='" . $_SESSION['delivery_fee'] . "'>";
    echo "<input type='submit' value='Checkout' style='background-color:#db4f66; padding: 10px 20px; border: none; cursor: pointer;'>";
    echo "</form>";
    
    echo "</div>";
}
 else {
    echo "<p>Your cart is empty.</p>";
}
?>
<br>
<a href="shop.php"><Button style='background-color:#db4f66;  padding: 10px 20px; border: none; cursor: pointer;'>Continue Shopping</Button></a>
</div>
</body>
</html>