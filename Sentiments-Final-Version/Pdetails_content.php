<?php

	include_once('database_connection.php');

	$id = "";

	if(isset($_GET["id"]))

	{
		$id = $_GET["id"]; 
	}

	$detailQuery = "SELECT * FROM produts WHERE P_ID = $id"; 
	$detailResult = mysqli_query($conn, $detailQuery);

?>

<div class="content">     
		
	<section class="contact_section layout_padding">
		<div class="container px-0">
			<div class="heading_container ">
				<h2 class="">
					Product Details
				</h2>
				<?php

					if ($detailResult && mysqli_num_rows($detailResult) > 0) {

						while ($row = mysqli_fetch_assoc($detailResult)) {

							$product_id = $row['P_ID'];
							$product_name = $row['P_Name'];
							$filename = $row['P_Image'];
							$description = $row['P_Description']; 
							$price = $row['P_Price'];
							$product_qty = $row['Prod_qty'];

							$imageURL="images/". $filename;
				?>

					<div class="row">
						<div class="col-md-5" style="background-color: white;"> 
							<img src="<?php echo $imageURL; ?>" style="width: 100%;">
						</div>
						<div class="col-md-7">
							<h3><?php echo $product_name; ?></h3>
							<a>Price: <?php echo 'R' . $price; ?></p>
							<h5><?php echo $description; ?></h5>
						<?php
							if ($product_qty == 0)
							{
								echo '<h4 style="color:red">Out of Stock</h4>';
								echo '
								<div class="col-md-6">
										<button
											disabled="disabled"
											class="btn mb-2 fw-bold w-100 btn-danger">
											Buy Now
										</button>

								</div>
								<div class="col-md-6">
										<button
											disabled="disabled"
											class="btn mb-2 fw-bold w-100 btn-success add-to-cart"
											data-product-id="'.$product_id.'">
											Add to Cart
										</button>
								</div>';
							}else{
								echo '<h4 style="color:green">In Stock</h4>';
							
									  echo '
									  <div class="col-md-6">
										  <a href="cart.php">
											  <button class="btn mb-2 fw-bold w-100  add-to-cart"
											  data-product-id="' . $product_id . '"
											  data-product-name="' . $product_name . '"
											  data-product-desc="' . $description . '"
											  data-product-image="' . $filename . '"
											  data-product-price="' . $price . '">
											 
												  Buy Now
											  </button>
										  </a>
									  </div>
									  <div class="col-md-6">
										  <a href="">
											  <button class="btn mb-2 fw-bold w-100 btn-success add-to-cart"
												  style="min-width: 150px;"
												  data-product-id="' . $product_id . '"
												  data-product-name="' . $product_name . '"
												  data-product-desc="' . $description . '"
												  data-product-image="' . $filename . '"
												  data-product-price="' . $price . '">
												  Add to Cart
											  </button>
										  </a>
									  </div>';
							};
					?>
					<div class="product-reviews">
    <h2 class="text-center">Product Reviews</h2>
    <?php
    $reviewQuery = "SELECT * FROM reviews WHERE product_id = $product_id";
    $reviewResult = mysqli_query($conn, $reviewQuery);

    // Create a button to toggle reviews
    echo '<button id="toggleReviews" class="toggle-reviews-button">Toggle Reviews</button>';

    // Create a container for the reviews and set it to hidden initially
    echo '<div id="reviewsContainer" style="display: none;">';

    if ($reviewResult && mysqli_num_rows($reviewResult) > 0) {
        while ($review = mysqli_fetch_assoc($reviewResult)) {
            $review_comment = $review['comment'];
            $rating = $review['rating'];
            
            echo "<p class='review-comment'>Review: $review_comment</p>";
            echo "<p class='review-comment'>Rating: ";
            
            // Display stars based on the rating value
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= $rating) {
                    echo '<span class="star">★</span>'; // Filled star for rating
                } else {
                    echo '<span class="star">☆</span>'; // Empty star for rating
                }
            }
            
            echo "</p><br>";
        }
    } else {
        echo "<p class='no-reviews'>No reviews yet. Be the first to review this product!</p>";
    }

    echo '</div>'; // Close the reviews container
    ?>

    <!-- JavaScript to toggle reviews -->
    <script>
        const toggleButton = document.getElementById('toggleReviews');
        const reviewsContainer = document.getElementById('reviewsContainer');

        toggleButton.addEventListener('click', () => {
            if (reviewsContainer.style.display === 'none' || reviewsContainer.style.display === '') {
                reviewsContainer.style.display = 'block';
                toggleButton.innerText = 'Hide Reviews';
            } else {
                reviewsContainer.style.display = 'none';
                toggleButton.innerText = 'Show Reviews';
            }
        });
    </script>
</div>
						</div>
					</div>
				<?php
						}
					}	
				?>
				

			</div>
		</div>
	</section>
</div>

                    
                    <div class="submit-review" style="text-align: center;">
                        <h2 class="text-center">Submit a Review</h2>
                        <form action="submit_review.php" method="post">
							
							<input type="number" hidden name="product_id" value=<?php echo $id ?> required><br>

							<label for="rating">Rating (1-5):</label>
							<input type="number" name="rating" min="1" max="5" required><br>

							<label for="comment">Comment:</label><br>
							<textarea name="comment" rows="4" cols="50" required></textarea><br>

							<input type="submit" style="background-color:#db4f66;" value="Submit Review">
                          </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
	<script>
    
	$(document).ready(function () {
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
</body>
</html>
