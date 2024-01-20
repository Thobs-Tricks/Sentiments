<?php
$I_id = "";

if (isset($_GET["id"])) {
    $I_id = $_GET["id"];
    
    $query = "SELECT t.Inv_id, t.Total_Price, t.Price_Vat, t.Inv_date, f.P_Name
              FROM invoice t
              INNER JOIN bridge u ON t.Inv_id = u.Inv_id
              INNER JOIN produts f ON u.P_ID = f.P_ID
              WHERE t.Inv_id = $I_id";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $rows = mysqli_num_rows($result);

    if ($rows > 0) {
        $row = $result->fetch_assoc(); // Fetch one row for invoice details
        
        echo '<div class="UserInfo">';
        echo "<h2>Invoice ID=INV-" . $row['Inv_id'] . "</h2>";
        echo "<h3>Products</h3>";
        echo '<table class="table table-striped table-sm" style="background-color: white;">
                <thead>
                  <tr>
                    <th>Product Name</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                  </tr>
                </thead>
                <tbody id="product_list">';

        // Fetch and display products for the invoice
        $productQuery = "SELECT f.P_Name, u.U_Price, u.Quantity, u.T_Price
                         FROM bridge u
                         INNER JOIN produts f ON u.P_ID = f.P_ID
                         WHERE u.Inv_id = {$row['Inv_id']}";
        $productResult = mysqli_query($conn, $productQuery);

        if ($productResult && mysqli_num_rows($productResult) > 0) {
            while ($productRow = mysqli_fetch_assoc($productResult)) {
                echo '<tr>';
                echo '<td>' . $productRow['P_Name'] . '</td>';
                echo '<td>' . 'R' . $productRow['U_Price'] . '</td>';
                echo '<td>' . $productRow['Quantity'] . '</td>';
                echo '<td>' . 'R' . $productRow['T_Price'] . '</td>';
                echo '</tr>';
            }
        } else {
            echo "<tr><td colspan='4'>No products found for this invoice.</td></tr>";
        }

        echo '</tbody></table>';
        echo "<p><b>Subtotal:</b>R" . $row['Total_Price']- $row['Price_Vat'] . "</p>";
        echo "<p><b>Vat:</b>R" . $row['Price_Vat'] . "</p>";
        echo "<p><b>Total Price:</b>R" . $row['Total_Price'] . "</p>";
        echo "<a href='download.php?id={$row['Inv_id']}'><button class='col-md-2' style='background-color:#db4f66;'>Download Invoice</button><a/><br>";
        echo "<a href='invoice.php'><button class='col-md-2' style='background-color:#db4f66;'>Back to Invoices</button></a>";
        echo '</div>';
    } 
}
?>
