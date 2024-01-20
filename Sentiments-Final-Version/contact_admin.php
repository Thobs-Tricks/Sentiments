<div class="content" style="padding: 10px;">
        <div class="col-10">
      		<h2>Special Requests</h2>
      	</div>

        <div class="table-responsive">
                <table class="table table-striped table-sm">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message</th>
                    </tr>
                </thead>
                <tbody id="List of Requests">
                <?php


                    if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['C_ID'];
                        $Email = $row['C_email'];
                        $Name = $row['C_name'];
                        $Message = $row['C_message'];
                        $Phone =$row['C_phone'];
                        ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $Name; ?></td>
                            <td><?php echo $Email; ?></td>
                            <td><?php echo $Phone; ?></td>
                            <td><?php echo $Message; ?></td>
                        
                        </tr>
                    <?php
                    } } else {
                    echo "<p>No Requests found.</p>";
                }
                    ?>
                </tbody>
                </table>
            </div>
            </div>
            

