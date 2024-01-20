<!--<form action="" method="GET">
					<div class="row">
						<div class="col-md-4">
							<div class="input-group mb-3">
								<select name="filter-price" class="form-control"> 
									<option value="">--Select Option--</option>
									<option value="low-price" <?php if(isset($_GET['filter-price']) && $_GET['filter-price'] == "low-price"){ echo "selected";} ?> >From Low Price</option>
									<option value="high-price" <?php if(isset($_GET['filter-price']) && $_GET['filter-price'] == "high-price"){ echo "selected";} ?> >From High Price</option>
								</select>
								<button type="submit" class="input-group-text btn btn-primary" id="filter">Filter</button>
							</div>
						</div>
					</div>
				</form>-->
			
				<?php
					$filter_option = "";
					if(isset($_GET['filter-price']))
					{
						if($_GET['filter-price'] == "low-price")
						{
							$filter_option = "ASC";
						}elseif($_GET['filter-price'] == "high-price")
						{
							$filter_option = "DESC";
						}
					}
					$query = "SELECT * FROM produts ORDER BY P_Price $filter_option"; 
					$query_filter = mysqli_query($conn, $query);

					if ($query_filter && mysqli_num_rows($query_filter) > 0) {
						?>
						<div class="container-xl product-container" data-filter="<?php echo $row['P_Price']; ?>">
							<div class="row">
								<?php
								while ($row = mysqli_fetch_assoc($query_filter)) {
									$product_id = $row['P_ID'];
									$filename = $row['P_Image'];
									$name = $row['P_Name'];
									$description = $row['P_Description'];
									$price = $row['P_Price'];

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
												  style="min-width: 150px;margin-right:10px "
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
				?>