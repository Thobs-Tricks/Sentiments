<?php
session_start();
?>

<html>
<head>
    <title>Checkout</title>
</head>
<body>
<h1>Checkout Summary</h1>

<?php
if (isset($_POST['cart_data']) && isset($_POST['discount']) && isset($_POST['delivery_fee'])) {
    $cart = json_decode($_POST['cart_data'], true);
    $discount = floatval($_POST['discount']); // Retrieve the discount amount
    $delivery_fee = floatval($_POST['delivery_fee']); ;

    // Now you have the cart data in $cart and the discount amount in $discount
    // Calculate the total price and include the discount in the total

    echo "<div>";
    $total_items = 0;
    $total_price = 0;

    foreach ($cart as $product_id => $item) {
        $product_name = $item['product_name'];
        $product_price = $item['product_price'];
        $quantity = $item['quantity'];
        $item_total_price = $product_price * $quantity;

        $total_items += $quantity;
        $total_price += $item_total_price;

        echo "<p>Product: $product_name</p>";
        echo "<p>Price: R$product_price</p>";
        echo "<p>Quantity: $quantity</p>";
        echo "<p>Total Price: R$item_total_price</p>";
    }

    echo "<p>Total Items in Cart: $total_items";

    $vat_rate = 0.15;
    $subtotal = round($total_price / (1 + $vat_rate), 2);
    $vat_amount = round($total_price - $subtotal, 2);
   
    $total_with_delivery_fee = $total_price + $delivery_fee;

    echo "<p>Subtotal (Excluding VAT): R$subtotal</p>";
    echo "<p>VAT (Value Added Tax): R$vat_amount</p>";
    echo "<p>Delivery Fee: R$delivery_fee</p>";

    // Include the discount in the total
    $total_with_discount = $total_with_delivery_fee - ($total_with_delivery_fee * ($discount / 100));

    echo "<p>Discount Applied: $discount%</p>";
    echo "<p>Total (Including VAT, Delivery Fee, and Discount): R$total_with_discount</p>";

    echo "</div";

    echo "<form action='c.php'>";
    echo "<button type='submit'>Go back to Cart</button>";
    echo "</form>";


} else {
    echo "<p>No items in the cart or discount not applied.</p>";
}
?>

<?php


// Check if the "Place Order" button is clicked
if (isset($_POST['place_order'])) {
   

    // Retrieve cart data
    $cart_data = json_decode($_POST['cart_data'], true);

    // Retrieve the total price with discount
    $total_with_discount = $_POST['total_with_discount'];

    // Insert the order information into the invoice database
    // You can follow the same steps as mentioned earlier for this

    // Additional order processing logic can be added here

    // Display a success message or redirect to a confirmation page
    echo "Order successfully placed! Thank you, $customer_name!";
} else {
    // Display the checkout form
    echo '<form action="c.php" method="post">
        <input type="hidden" name="cart_data" value="' . htmlentities(json_encode($_SESSION['cart'])) . '">
        <input type="hidden" name="total_with_discount" value="' . $total_with_discount . '">
        <input type="submit" name="place_order" value="Place Order">
    </form>';
}
?>

</body>
</html>
