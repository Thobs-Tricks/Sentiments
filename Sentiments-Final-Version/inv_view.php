<?php
include 'database_connection.php'; 


$I_id = "";

if(isset($_GET["id"]))

{
    $I_id = $_GET["id"]; 
}

$query = "SELECT t.Inv_id,t.Total_Price, t.Price_Vat,t.Inv_date, u.U_Price, u.T_Price,f.P_Name
FROM invoice t
INNER JOIN bridge u ON t.Inv_id = u.Inv_id
INNER JOIN produts f ON u.P_ID = f.P_ID
WHERE t.Inv_id = $I_id";


$pageTitle = "Invoice Details";
$content = 'inv_view_Content.php';
include 'master.php'

?>