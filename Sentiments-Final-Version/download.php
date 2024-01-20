<?php
include 'database_connection.php';

$I_id = "";

if (isset($_GET["id"])) {
    $I_id = $_GET["id"];
    
    $query = "SELECT t.Inv_id, t.Total_Price, t.Price_Vat, t.Inv_date,t.Delivery_fee,t.Discount, f.P_Name
              FROM invoice t
              INNER JOIN bridge u ON t.Inv_id = u.Inv_id
              INNER JOIN produts f ON u.P_ID = f.P_ID
              WHERE t.Inv_id = $I_id";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $rows = mysqli_num_rows($result);

    if ($rows > 0) {
        $row = $result->fetch_assoc(); // Fetch one row for invoice details
        
        // Create a PDF instance
        require_once('FDP/fpdf.php');
        $pdf = new FPDF();

        // Set document information
        $pdf->SetCreator('Your Name');
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice');
        
        // Add a page
        $pdf->AddPage();

        // Output invoice details to PDF
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(0, 10, 'Invoice ID: INV-' . $row['Inv_id'], 0, 1);
        $pdf->Cell(0, 10, 'Products', 0, 1);
        
        $pdf->SetFont('times', '', 10);
        $pdf->Ln();
        $pdf->Cell(40, 10, 'Product Name', 1);
        $pdf->Cell(30, 10, 'Unit Price', 1);
        $pdf->Cell(30, 10, 'Quantity', 1);
        $pdf->Cell(30, 10, 'Total Price', 1);
        $pdf->Ln();

        // Fetch and display products for the invoice in the PDF
        $productQuery = "SELECT f.P_Name, u.U_Price, u.Quantity, u.T_Price
                         FROM bridge u
                         INNER JOIN produts f ON u.P_ID = f.P_ID
                         WHERE u.Inv_id = {$row['Inv_id']}";
        $productResult = mysqli_query($conn, $productQuery);

        if ($productResult && mysqli_num_rows($productResult) > 0) {
            while ($productRow = mysqli_fetch_assoc($productResult)) {
                $pdf->Cell(40, 10, $productRow['P_Name'], 1);
                $pdf->Cell(30, 10, 'R' . $productRow['U_Price'], 1);
                $pdf->Cell(30, 10, $productRow['Quantity'], 1);
                $pdf->Cell(30, 10, 'R' . $productRow['T_Price'], 1);
                $pdf->Ln();
            }
        } else {
            $pdf->Cell(0, 10, 'No products found for this invoice.', 0, 1);
        }

        $pdf->Cell(0, 10, 'Subtotal: R' . ($row['Total_Price'] - $row['Price_Vat']), 0, 1);
        $pdf->Cell(0, 10, 'Vat: R' . $row['Price_Vat'], 0, 1);
        $pdf->Cell(0, 10, 'Delivery Fee: R' . $row['Delivery_fee'], 0, 1);
        $pdf->Cell(0, 10, 'Discount : %' . $row['Discount'], 0, 1);
        $pdf->Cell(0, 10, 'Total Price: R' . $row['Total_Price'], 0, 1);

        // Output the PDF for download
        $pdf->Output('INV-'.$row['Inv_id'].'.pdf', 'D');

       
        exit();
    } 
}
?>
