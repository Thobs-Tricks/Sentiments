<div class="container-fluid">
  <div class="row">
    

  <div class="row">
      	<div class="col-10">
      		<h2>Registered Customers</h2>
      	</div>
      	
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm" style="background-color: white;">
          <thead>
            <tr>
              <th>Name</th>
              <th>Surname</th>
              <th>Email</th>
              <th>Date Registerd</th>
              <th>Last Login</th>
            </tr>
          </thead>
          <tbody id="invoice_list">
          <?php
           
           $sql = "SELECT F_Name, L_Name, Email,registration_date,last_login FROM user ";
          $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                  $name = $row['F_Name'];
                  $surname = $row['L_Name'];
                  $email= $row['Email'];
                  $reg = $row['registration_date'];
                  $login = $row['registration_date'];
                  ?>
                <tr>
                    <td><?php echo $name; ?></a></td>
                    <td><?php echo $surname ; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $reg; ?></td>
                    <td><?php echo $login; ?></td>
                    
                </tr>
              
            <?php
            } } else {
              echo "<p>No Customers found.</p>";
          }
        
            ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>