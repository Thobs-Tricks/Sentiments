<div class="container-fluid">
  <div class="row">
    

  <div class="row">
      	<div class="col-10">
      		<h2>User Management</h2>
      	</div>
      	<div class="col-2">
      		<a href="#" data-toggle="modal" data-target="#add_user_modal" class="btn btn-primary btn-sm">Add Admin/User</a>
      	</div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>ID</th>
              <th>Email</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Password</th>
              <th>Role</th>
              <th>Address</th>
              <th>Phone</th>
              <th>Gender</th>
              <th>Date of Birth</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="List of Users">
          <?php


            if ($result && mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                  $User_id = $row['id'];
                  $U_Email = $row['Email'];
                  $F_Name = $row['F_Name'];
                  $L_Name = $row['L_Name'];
                  $U_Pass = $row['Password'];
                  $U_Role = $row['role'];
                  $U_Address = $row['Address'];
                  $U_Phone =$row['Phone'];
                  $U_Gender =$row['Gender'];
                  $U_dob = $row['DOB'];
                  ?>
                <tr>
                    <td><?php echo $User_id; ?></td>
                    <td><?php echo $U_Email; ?></td>
                    <td><?php echo $F_Name; ?></td>
                    <td><?php echo $L_Name; ?></td>
                    <td><?php echo $U_Pass; ?></td>
                    <td><?php echo $U_Role; ?></td>
                    <td><?php echo $U_Address; ?></td>
                    <td><?php echo $U_Phone; ?></td>
                    <td><?php echo $U_Gender; ?></td>
                    <td><?php echo $U_dob; ?></td>
                  
                    
                    
                    <td>
                    <a class="btn btn-sm btn-info edit-user" data-toggle="modal" data-target="#editUserModal" data-user-id="<?php echo $User_id; ?>"
                          data-user-email="<?php echo $U_Email; ?>"
                          data-user-fname="<?php echo $F_Name; ?>"
                          data-user-lname="<?php echo $L_Name; ?>"
                          data-user-password="<?php echo $U_Pass; ?>"
                          data-user-role="<?php echo $U_Role; ?>"
                          data-user-address="<?php echo $U_Address;  ?>"
                          data-user-phone="<?php echo $U_Phone; ?>"
                          data-user-gender="<?php echo $U_Gender; ?>"
                          data-user-phone="<?php echo $U_dob; ?>"
                          >Edit</a>
                        <a href="delUser.php?user_id=<?php echo $User_id; ?>" class="btn btn-sm btn-danger">Delete</a>

                    </td>
                </tr>
            <?php
            } } else {
              echo "<p>No Users found.</p>";
          }
            ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>



<!-- Add Product Modal start -->
<!-- Add Product Modal -->
<div class="modal fade" id="add_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Admin/User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="addUser.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="F_name"><b>First Name</b></label>
                        <input type="text" placeholder="Enter First Name" name="F_name" id="F_name" required>
                    </div>
                    <div class="form-group">
                        <label for="L_name"><b>Last Name</b></label>
                        <input type="text" placeholder="Enter Last Name" id="L_name" name="L_name" required>
                    </div>
                    <div class="form-group">
                        <label for="email"><b>Email</b></label>
                        <input type="email" placeholder="Enter Email" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
                    </div>
                    <div class="form-group">
                        <label for="psw"><b>Repeat Password</b></label>
                        <input type="password" placeholder="Enter Password" name="psw-repeat" id="cpsw" required>
                    </div>
                    <div class="form-group">
                        <label for="user_role">Role</label>
                        <select id="role" name="role" required>
                                <option value='Admin'>Admin</option>
                                <option value='Customer'>Customer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address"><b>Address</b></label>
                        <input type="text" placeholder="Enter Address(Optional)" name="address" id="address">
                    </div>
                    <div class="form-group">
                        <label for="phone"><b>Phone</b></label>
                        <input type="text" placeholder="Enter Phone Number" name="phone" id="phone" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="gender"><b>Gender</b></label>
                            <select id="gender" name="gender" required>
                                <option value='male'>Male</option>
                                <option value='female'>Female</option>
                                <option value='N/A'>Prefer Not To Respond</option>
                            </select>
                    </div>

                    <div class="form-group">
                        <label for="dob"><b>Date Of Birth</b></label>
                        <input type="date" placeholder="Date Of Birth" name="dob" id="dob">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Product Modal end -->
<!-- Edit Product Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel">Edit Admin/User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Edit Product Form -->
        <form action="Users.php" id="editUserForm" method="post" enctype="multipart/form-data">
          <input type="hidden" id="editUsertId" name="editUserId">
          <div class="form-group">
                        <label for="editF_name"><b>First Name</b></label>
                        <input type="text" class="form-control" name="editF_name" id="editF_name" required>
                    </div>
                    <div class="form-group">
                        <label for="editL_name"><b>Last Name</b></label>
                        <input type="text" class="form-control" name="editL_name" id="editL_name" required>
                    </div>
                    <div class="form-group">
                        <label for="editemail"><b>Email</b></label>
                        <input type="email" class="form-control" name="editemail" id="editemail" required>
                    </div>
                    <div class="form-group">
                        <label for="edituser_role">Role</label>
                        <select class="form-control" id="editrole" name="editrole" required>
                                <option value='Admin'>Admin</option>
                                <option value='Customer'>Customer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editaddress"><b>Address</b></label>
                        <input type="text" class="form-control" name="editaddress" id="editaddress">
                    </div>
                    <div class="form-group">
                        <label for="editphone"><b>Phone</b></label>
                        <input type="text" class="form-control" name="editphone" id="editphone" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="editgender"><b>Gender</b></label>
                            <select class="form-control" id="editgender" name="editgender" required>
                                <option value='male'>Male</option>
                                <option value='female'>Female</option>
                                <option value='N/A'>Prefer Not To Respond</option>
                            </select>
                    </div>

                    <div class="form-group">
                        <label for="editdob"><b>Date Of Birth</b></label>
                        <input type="date" class="form-control" name="editdob" id="editdob">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveChangesButton">Save Changes</button>
                </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- ... -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function () {
    // Click event handler for the "Edit" button
    $(document).on('click', '.edit-user', function () {
    var userId = $(this).data('user-id');
    var userfName = $(this).data('user-fname');
    var userlName = $(this).data('user-lname');
    var userEmail = $(this).data('user-email');
    var userPass = $(this).data('user-password');
    var userRole = $(this).data('user-role');
    var userAddress = $(this).data('user-address');
    var userPhone = $(this).data('user-phone');
    var userGender = $(this).data('user-gender');
    var userDob = $(this).data('user-dob');

    // Populate the form fields in the edit modal
    $('#edituserId').val(userId);
    $('#edituserfName').val(userfName);
    $('#edituserlName').attr(userlName);
    $('#edituserEmail').val(userEmail);
    $('#edituserPass').val(userPass);
    $('#edituserRole').val(userRole);
    $('#edituserAddress').val(userAddress);
    $('#edituserPhone').val(userPhone);
    $('#edituserGender').val(userGender);
    $('#edituserDob').val(userDob);
    // Show the edit modal
    $('#editUserModal').modal('show');
  });

    // Click event handler for the "Save Changes" button
    $('#saveChangesButton').click(function () {
    // Check if a new image file has been selected
    var newImageFile = $('#editProductImageFile')[0].files[0];

    // Create a FormData object to send the data
    var formData = new FormData();
    formData.append('userId', $('#edituserId').val());
    formData.append('F_Name', $('#edituserfName').val());
    formData.append('L_Name', $('#edituserlName').val());
    formData.append('email', $('#edituserEmail').val());
    formData.append('psw', $('#edituserPass').val());
    formData.append('user_role', $('#edituserRole').val());
    formData.append('address', $('#edituserAddress').val());
    formData.append('phone', $('#edituserPhone').val());
    formData.append('gender', $('#edituserGender').val());
    formData.append('dob', $('#edituserDob').val());

    // Append the new image file if selected
    if (newImageFile) {
      formData.append('productImageFile', newImageFile);
    }
    $("#editUserForm").submit();
    // Send the data to the server for processing using AJAX
    $.ajax({
      url: 'Users.php',
      method: 'POST',
      data: formData,
      processData: false, // Don't process the data
      contentType: false, // Set content type to false as FormData handles it
      success: function (response) {
        // Handle the server's response here
        // Close the modal after successful update
        $('#editUserModal').modal('hide');
        // You can also update the table dynamically here
      },
      error: function (xhr, status, error) {
        // Handle errors if the update fails
        console.error(xhr.responseText);
        // You might want to display an error message to the user here
      },
    });
  });
});

  $(document).ready(function () {
  // Click event handler for the "Delete" button
  $(document).on('click', '.btn-danger', function () {
    var productId = $(this).data('user-id');

    // Show a confirmation dialog before deleting
    if (confirm('Are you sure you want to delete the user?')) {
      // Send a request to the server to delete the product
      $.ajax({
        url: 'del_product.php',
        method: 'POST',
       
        success: function (response) {
          // Handle the server's response here
          // You can remove the product from the UI if deletion was successful
          if (response === 'success') {
            // Remove the product from the UI, e.g., by selecting the product's container and calling .remove()
            // Example: $(this).closest('tr').remove();
          } else {
           
          }
        },
        error: function (xhr, status, error) {
          // Handle errors if the request fails
          console.error(xhr.responseText);
        },
      });
    }
  });
});
// Function to preview the selected image in the edit modal
function previewEditImage(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#editProductImage').attr('src', e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

  function previewAddImage(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#product_image_preview').attr('src', e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
</script>





