<div class="cart-container" style="padding: 10px">
    <h2>Checkout Summary</h2>
<?php
    include 'database_connection.php';
    if (isset($_SESSION['id'])) {
       $id = $_SESSION['id'];

?>

<?php
if (isset($_POST['cart_data']) && isset($_POST['discount']) && isset($_POST['delivery_fee'])) {
    $cart = json_decode($_POST['cart_data'], true);
    $discount = floatval($_POST['discount']); // Retrieve the discount amount
    $delivery_fee = floatval($_POST['delivery_fee']); ;

    

    echo "<div>";
    $total_items = 0;
    $total_price = 0;

    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product_id => $item) {
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

   

}
    
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
    $total_with_discount =isset($_POST['total_with_discount']) ? floatval($_POST['total_with_discount']) : 0;
   
    $vat_amount = isset($_POST['vat_amount']) ? floatval($_POST['vat_amount']) : 0;
    $discount = isset($_POST['discount']) ? floatval($_POST['discount']) : 0;
    $delivery_fee = isset($_POST['delivery_fee']) ? floatval($_POST['delivery_fee']) : 0;
   
    // Insert the order information into the invoice database
    $query = "INSERT INTO invoice (U_Id, Inv_date) VALUES (?, NOW())";
    $st = $pdo->prepare($query);
    $st->execute([$id]);

    $invoiceID = $pdo->lastInsertId();
    
        foreach ( $cart_data  as $product_id => $item) {
        $product_name = $item['product_name'];
        $product_price = $item['product_price'];
        $quantity = $item['quantity'];
        $item_total_price = $product_price * $quantity;

       
       $query = "INSERT INTO bridge (Inv_Id, P_ID, Quantity, U_Price, T_Price) VALUES (?, ?, ?, ?, ?)";
                    $st = $pdo->prepare($query);
                    $st->execute([$invoiceID, $product_id, $quantity, $product_price,   $item_total_price]);

                    
                    
                   
    }



    $query1 = "UPDATE invoice SET Total_Price='$total_with_discount', Delivery_fee='$delivery_fee',Discount='$discount',Price_Vat='$vat_amount' WHERE Inv_Id= $invoiceID ";
    
 if (mysqli_query($conn, $query1)) {
    
    unset($_SESSION['cart']);
    $_SESSION['cart_count'] = 0;
   
   echo '<script>window.location.href="invoice.php";</script>';
    
  } else {
    echo 'Error updating product: ' . mysqli_error($conn);
  }
   
} else {
    // Display the checkout form
    echo '<div>';
    echo '<form action="checkout.php" method="post">
    <input type="hidden" name="cart_data" value="' . htmlentities(json_encode($_SESSION['cart'])) . '">
    <input type="hidden" name="total_with_discount" value="' . $total_with_discount . '">
    <input type="hidden" name="discount" value="' . $discount . '">
    <input type="hidden" name="delivery_fee" value="' . $delivery_fee . '">
    <input type="hidden" name="vat_amount" value="' . $vat_amount . '">
    <input type="submit" name="place_order" value="Place Order" style="background-color:#db4f66; padding: 10px 20px; border: none; cursor: pointer;">
</form>';
}

}
else
{
    echo 'Please Login First';
}



?>