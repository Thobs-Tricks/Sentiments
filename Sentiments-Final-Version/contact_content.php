<div class="content">     
    
  <section class="contact_section layout_padding">
    <div class="container px-0">
      <div class="heading_container ">
        <h2 class="">
          Contact Us
        </h2>
      </div>
    </div>

    

    <div class="container container-bg">
      <div class="row">
        <div class="col-lg-7 col-md-6 px-0">
          <div class="map_container">
            <div class="map-responsive">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14321.736136949454!2d27.976891387158197!3d-26.182555599999986!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1e950b95efab59f1%3A0x3d9ee40e6cfbca2c!2sUniversity%20of%20Johannesburg%20Student%20Center%20-%20Auckland%20Park%20Campus!5e0!3m2!1sen!2sza!4v1693184678843!5m2!1sen!2sza" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-5 px-0">
          <form action="contact.php" method="POST">
            <div>
              <input type="text" placeholder="Name" id="name" name="name"/>
            </div>
            <div>
              <input type="email" placeholder="Email" id="email" name="email"/>
            </div>
            <div>
              <input type="text" placeholder="Phone" id="phone" name="phone"/>
            </div>
            <div>
              <input type="text" class="message-box" placeholder="Your Request" id="message" name="message"/>
            </div>
            <div class="d-flex ">
              <button type="submit">
                SEND
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- end contact section -->
  </div>
  
  <?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Validate input (e.g., check if the product_id exists)
    // ...

    // Insert the review into the database
   $query = "INSERT INTO contactus (C_name,C_email,C_phone,C_message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $name, $email, $phone, $message);

    if ($stmt->execute()) {
        // Review inserted successfully
        echo '<script>window.location.href = "contact.php";</script>'; // Redirect to a page that displays reviews
        exit();
    } else {
        // Handle the error
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

?>