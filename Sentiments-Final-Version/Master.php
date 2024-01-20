<?php

include 'database_connection.php'; // Include the database connection file
require_once 'functions.php';

if (isset($_SESSION['cart_count'])) {
  $cartCount = $_SESSION['cart_count'];
} else {
  $cartCount = 0; // Default to 0 if not set
}

?>



<!DOCTYPE html>
<html>

<head>
   <!-- Basic -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
  <title><?php echo $pageTitle; ?></title>
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- Custom styles for this template -->
  <link href="./css/style.css" rel="stylesheet" />
  
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <script src="js/index.js"></script>

  <script src="cart.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<!-- Include Bootstrap CSS and JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Include Bootstrap and jQuery libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>



</head>

<body>

    <!-- header section strats -->
    <header class="header_section">
     
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
         
        <a class="navbar-brand" href="index.php">
            <img class="logo" src="images/favicon.png">
        </a>
        
          <ul class="navbar-nav  ">
         
   <?php
if (isset($_SESSION['email'])) {
    // User is logged in
    $email = $_SESSION['email'];
    $role = $_SESSION['role'];

    echo '  <li class="nav-item">
    <form class="form-inline">
         <div class="search-bar">
           <input type="search" class="search-input" placeholder="🔍 Search...">
         </div>
        </form> </li>';

    // Display navigation items based on the user's role
    if ($role == 'admin') {
        // Admin-specific navigation items
        echo '<li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>';
        echo '<li class="nav-item"><a class="nav-link" href="shop.php">Shop </a></li>';
        echo '<li class="nav-item"><a class="nav-link" href="testimonial.php">Reviews</a></li>';
        echo '<li class="nav-item "><a class="nav-link" href="edit_Products.php">Products</a></li>';
    
        echo '<li class="nav-item dropdown">';
        echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        echo 'Manage';
        echo '</a>';
        echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
        echo '<a class="dropdown-item" href="Orders.php">Orders</a>';
        echo '<a class="dropdown-item" href="Customers.php">Customers</a>';
        echo '<a class="dropdown-item" href="Users.php">User Management</a>';
        echo '<a class="dropdown-item" href="admin_contact.php">Requests</a>';
        echo '</div>';
        echo '</li>';
        
        echo '<li class="nav-item"><a class="nav-link" href="profile.php"><i class="fa fa-user-circle-o" style="font-size:24px"></i><span>Profile</span></a></li>';
    } elseif ($role == 'customer') {
        // Regular user-specific navigation items

       
        echo '<li class="nav-item active"><a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a></li>';
        echo '<li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>';
        echo '<li class="nav-item"><a class="nav-link" href="testimonial.php">Review</a></li>';
        echo '<li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>';
        echo '<li class="nav-item dropdown">';
        echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        echo 'Account';
        echo '</a>';
        echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
        echo '<a class="dropdown-item" href="invoice.php">Invoices</a>';
        echo '<a class="dropdown-item"href="profile.php"><i class="fa fa-user-circle-o" style="font-size:24px"></i><span>Profile</span></a>';
        echo '</div>';
        echo '</li>';
        echo '<li class="nav-item"><a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart" style="font-size:30px;"></i><span class="cart-count" id="cartCount">' . $cartCount . '</span></a></li>';
    }

    echo '<li class="nav-item"><a class="nav-link" href="Logout.php">LogOut</a></li>';
} else {
    // User is not logged in
    echo '<form class="form-inline">
    <div class="search-bar">
      <input type="search" class="search-input" placeholder="🔍 Search...">
    </div>
   </form>';
    echo '<li class="nav-item active"><a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="testimonial.php">Review</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="index.php" data-toggle="modal" data-target="#loginModal"><i class="fa fa-user" aria-hidden="true"></i><span>Login</span></a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="index.php" data-toggle="modal" data-target="#signupModal"><i class="fa fa-user" aria-hidden="true"></i><span>Register</span></a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart" style="font-size:30px;"></i><span class="cart-count" id="cartCount">' . $cartCount . '</span></a></li>';
}
?>
          </ul >
  <!-- Login Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="loginModalLabel" style="color:rgb(255, 105, 180)">Login</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="Login.php" method="POST">
      <div class="textField">
      <label>E-mail</label>
          <input type="text" name="email" required>
          
      </div>
      <div class="textField">
      <label>Password</label>
          <input type="password" name="password" required>
        </div>
        <input type="submit" value="Login" style="background-color:rgb(255, 105, 180); color:white; border-radius:3px;">
      <a href="index.php" data-dismiss="modal">Close</a>
      <p><a href="#" class="forgotPass">Forgot Password?</a></p>
      <p class="signUp">Not registered? <a href="register.php" data-toggle="modal" data-target="#loginModal">Sign Up Here</a> </p>
      
      
  </form>
      </div>
    </div>
  </div>
</div>

<!----Sign Up---->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="signupModalLabel" style="color:rgb(255, 105, 180)">Register</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form class="modal-content2" action="register.php" method="POST">
          
          <p>Please fill in this form to create an account.</p>
          <hr>
          <label for="F_name"><b>First Name</b></label>
          <input type="text" placeholder="Enter First Name" name="F_name" required>
  
          <label for="L_name"><b>Last Name</b></label>
          <input type="text" placeholder="Enter Last Name" name="L_name" required>
  
          <label for="email"><b>Email</b></label>
          <input type="email" placeholder="Enter Email" name="email" required>
  
          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="psw" required>
  
          <label for="psw-repeat"><b>Repeat Password</b></label>
          <input type="password" placeholder="Repeat Password" name="psw-repeat" required> 

          <label for="address"><b>Address</b></label>
          <input type="text" placeholder="Enter Address(Optional)" name="address">

          <label for="phone"><b>Phone</b></label>
          <input type="text" placeholder="Enter Phone Number" name="phone" required>
       
          <label for="gender"><b>Gender</b></label>
        <select id="gender" name="gender" required>
            <option value='male'>Male</option>
            <option value='female'>Female</option>
            <option value='N/A'>Prefer Not To Respond</option>
          </select>
          <label for="dob"><b>Date Of Birth</b></label>
          <input type="text" placeholder="Date Of Birth" name="dob">
          <label>
              <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px;color:pink;"> Remember me
          </label>
  
          <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
          <button type="submit" style="background-color:rgb(255, 105, 180)" class="signupbtn">Register</button>
          <br>
          <p><a href="index.php" data-dismiss="modal" style="position: absolute; bottom:30px; right:30px;">Close</a></p>
      </div>
  </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>

 <!-- Forgot Password Model -->
 <div class="modal fade" id="forgotPModal" tabindex="-1" role="dialog" aria-labelledby="forgotPModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="forgotPModelLabel">Recover Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="recover.php" method="POST">
        <div class="textField">
        <label>E-mail</label>
            <input type="text" name="email" required>
        </div>
        <input type="submit" value="Submit" name="submit">
        <a href="index.php" data-dismiss="modal">Close</a>        
    </form>
        </div>
      </div>
    </div>
  </div>


<?php
if (isset($_GET['registration_success']) && $_GET['registration_success'] === 'true') {
    echo '<p>Registration successful. You can now <a href="#" data-toggle="modal" data-target="#loginModal">log in</a>.</p>';
}
?>



<main>
        <?php include $content; ?>
  </main>

   
  <!-- info section -->

  <section class="info_section  layout_padding2-top">
    <div class="social_container">
      <div class="social_box">
        <a href="">
          <i class="fa fa-facebook" aria-hidden="true"></i>
        </a>
        <a href="">
          <i class="fa fa-twitter" aria-hidden="true"></i>
        </a>
        <a href="">
          <i class="fa fa-instagram" aria-hidden="true"></i>
        </a>
        <a href="">
          <i class="fa fa-youtube" aria-hidden="true"></i>
        </a>
      </div>
    </div>
    <div class="info_container ">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3">
            <h6>
              ABOUT US
            </h6>
            <p>Whether you're celebrating birthdays, anniversaries, weddings, or simply looking to brighten someone's day, we offer a diverse range of handpicked items that are sure to bring smiles to faces. 
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="info_form ">
              <h5>
                Newsletter
              </h5>
              <form action="#">
                <input type="email" placeholder="Enter your email">
                <button>
                  Subscribe
                </button>
              </form>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <h6>
              NEED HELP
            </h6>
            <p>
            If you're in need of assistance or have any questions, our dedicated support team is here to help you every step of the way. 
            </p>
          </div>
          <div class="col-md-6 col-lg-3">
            <h6>
              CONTACT US
            </h6>
            <div class="info_link-box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span> 5 Kingsway Ave, Rossmore, Johannesburg, 2092 </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>+27 712345678</span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span> sentiments@gmail.com</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
   
    <!-- footer section  -->
    <footer class=" footer_section">
      <div class="container">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="https://html.design/">Free Html Templates</a>
        </p>
      </div>
    </footer>
    
    <!-- footer section  -->

  </section> 

  <!-- end info section -->

  <!-- Include jQuery and Bootstrap JavaScript -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <script src="js/custom.js"></script>
  
 
  
</body>

</html>