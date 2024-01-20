<!-- client section -->
<section class="client_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Testimonial
            </h2>
        </div>
    </div>
    <div class="container px-0">
        <div id="customCarousel2" class="carousel carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
         
                  <?php
              
                  $query = "SELECT t.user_id,t.user_content,u.id,u.F_Name, u.L_Name 
                            FROM testimonials t
                            INNER JOIN user u ON t.user_id = u.id";

                  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                  $rows = mysqli_num_rows($result);

                  if ($rows > 0) {
                      $active = true; 
                      while ($row = $result->fetch_assoc()) {
                      
                        $id = $row["id"];
                        // Display the user's name and quote
                        echo "<div class='carousel-item " . ($active ? "active" : "") . "'>";
                        echo "<div class='box'>";
                        echo "<div class='client_info'>";
                        echo "<div class='client_name'>";
                        echo "<h5>" . $row["F_Name"] . ' ' . $row["L_Name"] . "</h5>";
                        echo "</div>";
                        echo "<i class='fa fa-quote-left' aria-hidden='true'></i>";
                        echo "</div>";
                        echo "<p>" . $row["user_content"] . "</p>";
                
                        if(isset($_SESSION['id'])) {
                          $loggedInUserId = $_SESSION['id'];
                          echo "<a href='submit_testimonial.php?id=$loggedInUserId'><button style='background-color:#db4f66;' >Submit New Review</button><a>";
                      } 
                        
                      
                
                        echo "</div>";
                        echo "</div>";
                        
                        
                
                        $active = false; 
                    }
                } else {
                    echo "No testimonials found.";
                }
                

                  // Close the database connection
                  $conn->close();
                  ?>
        
            <div class="carousel_btn-box">
          <a class="carousel-control-prev" href="#customCarousel2" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#customCarousel2" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
            </div>
        
        </div>
  
      </div>
    
</section>




<script>
$(document).ready(function() {
    $('#customCarousel2').carousel();
});
</script>

<!-- end client section -->
