<?php
 $id = "";
if(isset($_GET["id"]))

{
          
           $id = $_GET["id"]; 
}
           ?>
<body style="text-align: center;">


<h2>Submit a Testimonial</h2>

<form action="submit_testimonial.php" method="post">
     
        
<input hidden type="number" value="<?php echo $id; ?>" name="user_id" required><br>
    <label for="comment">Comment:</label><br>
    <textarea name="comment" rows="4" cols="50" required></textarea><br>
    <input type="submit" value="Submit Review" style="background-color:#db4f66;border-radius:3px;">
    <br>
</form>

</body>

<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $userID = $_POST['user_id'];
    $comment = $_POST['comment'];

    // Validate input (e.g., check if the product_id exists)
    // ...

    // Insert the review into the database
   $query = "INSERT INTO testimonials (user_id,user_content) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $userID, $comment);

    if ($stmt->execute()) {
        // Review inserted successfully
        echo '<script>window.location.href = "testimonial.php";</script>'; // Redirect to a page that displays reviews
        exit();
    } else {
        // Handle the error
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

?>
