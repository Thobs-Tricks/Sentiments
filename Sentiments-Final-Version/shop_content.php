<!-- shop section -->
<section class="shop_section layout_padding">
			<div class="container">
				<div class="heading_container heading_center">
					<h2>Latest Products</h2>
				</div>


					<?php
					// Check if categories are available
					echo "<div class='form-group'>";
					if ($result && mysqli_num_rows($result) > 0) {
						// Start the category filter dropdown
					echo "<div class='form-group'>";
					echo "<label for='categorySelect'>Select Category:</label>";
					echo "<select class='form-control col-md-4' id='categorySelect'>";
							$categoryQuery = "SELECT DISTINCT P_Category_Type FROM produts";
							$categoryResult = mysqli_query($conn, $categoryQuery);
							echo "<option value='all'>All</option>";

							if ($categoryResult && mysqli_num_rows($categoryResult) > 0) {
								while ($row = mysqli_fetch_assoc($categoryResult)) {
									$category = $row['P_Category_Type'];
									echo "<option value='$category'>$category</option>";
								}
							}
							
					   echo "</select>" ;
					 echo "</div>";
						}
				  echo "</div>";
			?>

			

			
				

				

				<?php
				$selectedCategories = isset($_POST['categories']) ? $_POST['categories'] : array();

				// Check if categories are available
				if ($result && mysqli_num_rows($result) > 0) {
					// Initialize an array to keep track of displayed categories
					$displayedCategories = array();

				while ($categoryRow = mysqli_fetch_assoc($result)) {
					$category = $categoryRow['P_Category_Type'];

					// Check if this category has already been displayed
					if (!in_array($category, $displayedCategories)) {
						$displayedCategories[] = $category; // Add category to displayed list

						// Modify your SQL query to fetch products for the current category
						$categoryQuery = "SELECT * FROM produts WHERE P_Category_Type = '$category'";
						$categoryResult = mysqli_query($conn, $categoryQuery);

						if ($categoryResult && mysqli_num_rows($categoryResult) > 0) {
							?>
							<div class="container-xl product-container" data-category="<?php echo $category; ?>">
								<div class="row">
									<?php
									while ($row = mysqli_fetch_assoc($categoryResult)) {
										$product_id = $row['P_ID'];
										$filename = $row['P_Image'];
										$description = $row['P_Description'];
										$price = $row['P_Price'];
										$name = $row['P_Name'];

										$imageURL = "images/" . $filename;
										?>
										<div class="col-lg-4 col-sm-6 mb-4">
											<div class="bg-white p-2 shadow-md">
												<div class="text-center">
													<a href="product_detail.php?id=<?php echo $product_id; ?>">
														<img src="<?php echo $imageURL; ?>"
															style="width: 180px; height: 300px;"
															alt="<?php echo $filename; ?>">
													</a>
													<h3><?php echo $name; ?></h3>
													<p>Price: <?php echo 'R'.$price; ?></p>
													<div class="row pt-2">
													<div class="col-md-6">
														<div class="d-flex">
														<button class="btn mb-2 fw-bold w-100 btn-success add-to-cart"
														style="min-width: 150px;margin-right:10px;"
												  data-product-id=<?php echo $product_id; ?>
												  data-product-name=<?php echo $name; ?>
												  data-product-desc=<?php echo $description; ?>
												  data-product-image=<?php echo $filename; ?>
												  data-product-price=<?php echo $price; ?> >
												  Add to Cart
											  </button>
															<a href="product_detail.php?id=<?php echo $product_id; ?>" ><button class="btn mb-2 fw-bold btn-success view-detailsx" style="min-width: 150px;" >View Details</button></a>
														</div>
													</div>
												 </div>
												</div>
											</div>
										</div>
										<?php
									}
									?>
								</div>
							</div>
					<?php
				}
				 } else {
					
				}
			}
		}
		?>
			</div>

				
			<script>
				document.getElementById('categorySelect').addEventListener('change', function() {
					var selectedCategory = this.value;
					var allContainers = document.querySelectorAll('.product-container');

					allContainers.forEach(function(container) {
						container.style.display = 'none';
					});

					if (selectedCategory === 'all') {
						allContainers.forEach(function(container) {
							container.style.display = 'block';
						});
					} else {
						var selectedContainer = document.querySelector('.product-container[data-category="' + selectedCategory + '"]');
						if (selectedContainer) {
							selectedContainer.style.display = 'block';
						}
					}
				});
			</script>
				
			
		</section>
		<!-- end shop section -->
 <script>
    document.querySelector('.search-input').addEventListener('input', function() {
        var searchValue = this.value.toLowerCase();
        var allProducts = document.querySelectorAll('.product-container .col-lg-4');

        allProducts.forEach(function(product) {
            var productName = product.querySelector('h3').innerText.toLowerCase();
            if (productName.includes(searchValue)) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    });
	

		
</script>
<script>$(document).ready(function () {
    // Add to Cart button click event
    $('.add-to-cart').on('click', function () {
        var product_id = $(this).data('product-id');
        var product_name = $(this).data('product-name');
        var product_price = $(this).data('product-price');
        var product_image = $(this).data('product-image');
        var product_desc = $(this).data('product-desc');

        // AJAX request to add the product to the cart
        $.ajax({
            url: 'add_to_cart.php',
            method: 'POST',
            data: {
                product_id: product_id,
                product_name: product_name,
                product_price: product_price,
                product_image: product_image,
                product_desc: product_desc
            },
            success: function (response) {
                // Assuming your response contains the updated cart count
				$('#cartCount').text(response.cartCount);
                console.log("Product added to cart.");
				$.ajax({
                url: 'get_cart_count.php',
                method: 'GET',
				success: function (response) {
                // Update the cart count in the HTML
                $('#cartCount').text(response.cartCount);
                console.log(response.message);
            },
            error: function () {
                console.error("Failed to add the product to the cart.");
            }
		});
	}
	});
        });
    });
	</script>