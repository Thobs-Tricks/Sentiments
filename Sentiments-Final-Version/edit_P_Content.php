<div class="container-fluid">
  <div class="row">
    

  <div class="row">
      	<div class="col-10">
      		<h2>Product List</h2>
      	</div>
      	<div class="col-2">
      		<a href="#" data-toggle="modal" data-target="#add_product_modal" class="btn btn-primary btn-sm">Add Product</a>
      	</div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Image</th>
              <th>Description</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Category</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="product_list">
          <?php
            
            if ($result && mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                  $product_id = $row['P_ID'];
                  $product_Name = $row['P_Name'];
                  $filename = $row['P_Image'];
                  $description = $row['P_Description'];
                  $price = $row['P_Price'];
                  $category =$row['P_Category_Type'];
                  $product_quantity =$row['Prod_qty'];
                  $imageURL = "images/" . $filename;
                  ?>
                <tr>
                    <td><?php echo $product_id; ?></td>
                    <td><?php echo $product_Name; ?></td>
                    <td>
                        <img src="<?php echo $imageURL; ?>" alt="Product Image" width="100">
                    </td>
                    <td><?php echo $description; ?></td>
                    <td><?php echo $price; ?></td>
                    <td><?php echo $product_quantity;?></td>
                    <td><?php echo $category; ?></td>
                    
                    
                    <td>
                    <a class="btn btn-sm btn-info edit-product" data-toggle="modal" data-target="#editProductModal" data-product-id="<?php echo $product_id; ?>"
                          data-product-name="<?php echo $product_Name; ?>"
                          data-product-image="<?php echo $imageURL; ?>"
                          data-product-description="<?php echo $description; ?>"
                          data-product-price="<?php echo $price; ?>"
                          data-product-category="<?php echo $category;  ?>"
                          data-product-quantity="<?php echo $product_quantity; ?>"
                          >Edit</a>
                        <a href="del_product.php?product_id=<?php echo $product_id; ?>" class="btn btn-sm btn-danger">Delete</a>

                    </td>
                </tr>
            <?php
            } } else {
              echo "<p>No products found.</p>";
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
<div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="add_product.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="product_name">Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" required>
                    </div>
                    <div class="form-group">
                        <label for="product_image">Image</label>
                        <input type="file" class="form-control-file" id="product_image" name="product_image" accept="image/*" onchange="previewAddImage(this)" required>
                        <div class="form-group">
                           <img src="" alt="Product Image" id="product_image_preview" width="200">
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="product_description">Description</label>
                        <textarea class="form-control" id="product_description" name="product_description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="product_price">Price</label>
                        <input type="number" step="0.01" class="form-control" id="product_price" name="product_price" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="product_category">Category</label>
                        <input type="text" class="form-control" id="product_category" name="product_category" required>
                    </div>

                    <div class="form-group">
                        <label for="product_quantity">Quantity</label>
                        <input type="number" class="form-control" id="product_quantity" name="product_quantity" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Product Modal end -->
<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Edit Product Form -->
        <form action="edit_Products.php" id="editProductForm" method="post" enctype="multipart/form-data">
          <input type="hidden" id="editProductId" name="editProductId">
          <div class="form-group">
            <label for="editProductName">Product Name</label>
            <input type="text" class="form-control" id="editProductName" name="editProductName" required>
          </div>
          <div class="form-group">
            <label for="editProductImage">Product Image</label><br>
            <img src="" alt="Product Image" class="img-thumbnail" id="editProductImage"  width="200">
          </div>
          <div class="form-group">
            <label for="editProductImageFile">New Image</label>
            <input type="file" class="form-control-file" id="editProductImageFile" name="editProductImageFile" accept="image/*" onchange="previewEditImage(this)">
          </div>

          <div class="form-group">
            <label for="editProductDescription">Description</label>
            <textarea class="form-control" id="editProductDescription" name="editProductDescription" required></textarea>
          </div>
          <div class="form-group">
            <label for="editProductPrice">Price</label>
            <input type="number" class="form-control" id="editProductPrice" name="editProductPrice" step="0.01" required>
          </div>
          <div class="form-group">
            <label for="editProductCategory">Category</label>
            <input type="text" class="form-control" id="editProductCategory" name="editProductCategory" required>
          </div>
          <div class="form-group">
            <label for="editProductQuantity">Quantity</label>
            <input type="text" class="form-control" id="editProductQuantity" name="editProductQuantity" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="submit" id="saveChangesButton">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<!-- ... -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function () {
    // Click event handler for the "Edit" button
    $(document).on('click', '.edit-product', function () {
    var productId = $(this).data('product-id');
    var productName = $(this).data('product-name');
    var productImg = $(this).data('product-image');
    var productDescription = $(this).data('product-description');
    var productPrice = $(this).data('product-price');
    var productCategory = $(this).data('product-category');
    var productQuantity = $(this).data('product-quantity');

    // Populate the form fields in the edit modal
    $('#editProductId').val(productId);
    $('#editProductName').val(productName);
    $('#editProductImage').attr('src', productImg);
    $('#editProductDescription').val(productDescription);
    $('#editProductPrice').val(productPrice);
    $('#editProductCategory').val(productCategory);
    $('#editProductQuantity').val(productQuantity);
    // Show the edit modal
    $('#editProductModal').modal('show');
  });

    // Click event handler for the "Save Changes" button
    $('#saveChangesButton').click(function () {
    // Check if a new image file has been selected
    var newImageFile = $('#editProductImageFile')[0].files[0];

    // Create a FormData object to send the data
    var formData = new FormData();
    formData.append('productId', $('#editProductId').val());
    formData.append('productName', $('#editProductName').val());
    formData.append('productDescription', $('#editProductDescription').val());
    formData.append('productPrice', $('#editProductPrice').val());
    formData.append('productCategory', $('#editProductCategory').val());
    formData.append('productQuantity', $('#editProductQuantity').val());

    // Append the new image file if selected
    if (newImageFile) {
      formData.append('productImageFile', newImageFile);
    }
    $("#editProductForm").submit();
    // Send the data to the server for processing using AJAX
    $.ajax({
      url: 'edit_Products.php',
      method: 'POST',
      data: formData,
      processData: false, // Don't process the data
      contentType: false, // Set content type to false as FormData handles it
      success: function (response) {
        // Handle the server's response here
        // Close the modal after successful update
        $('#editProductModal').modal('hide');
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
    var productId = $(this).data('product-id');

    // Show a confirmation dialog before deleting
    if (confirm('Are you sure you want to delete this product?')) {
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





