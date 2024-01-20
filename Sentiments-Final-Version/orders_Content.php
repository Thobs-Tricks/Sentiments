<div class="container-fluid">
  <div class="row">
    

  <div class="row">
      	<div class="col-10">
      		<h2>All Orders</h2>
      	</div>
      	
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm" style="background-color: white;">
          <thead>
            <tr>
              <th>Invoice ID</th>
              <th>Total Price</th>
              <th>Vat(15%)</th>
              <th>Date</th>
              <th>User</th>
            </tr>
          </thead>
          <tbody id="invoice_list">
          <?php
            if (isset($_SESSION['id'])) {
              $id = $_SESSION['id'];
          $query = "SELECT * FROM invoice" ; 
          $result = mysqli_query($conn, $query);
            if ($result && mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                  $invoice_id = $row['Inv_id'];
                  $totalPrice = $row['Total_price'];
                  $userId = $row['U_Id'];
                  $Vat= $row['Price_Vat'];
                  $date = $row['Inv_date'];
                  ?>
                <tr>
                    <td><?php echo 'INV-'.$invoice_id; ?></a></td>
                    <td><?php echo 'R'.$totalPrice; ?></td>
                    <td><?php echo 'R'.$Vat; ?></td>
                    <td><?php echo $date; ?></td>
                    <td><?php echo $userId; ?></td>
                    
                </tr>
              
            <?php
            } } else {
              echo "<p>No Invoices found.</p>";
          }
        }
            ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>