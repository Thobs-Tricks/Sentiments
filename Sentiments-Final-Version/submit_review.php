<!DOCTYPE html>
<html>
<head>
    <title>Submit a Review</title>
</head>
<body>
    <h1>Submit a Review</h1>

    <form action="submit_review.php" method="post">
        <label for="product_id">Product ID:</label>
        <input type="number" name="product_id" required><br>

        <label for="rating">Rating (1-5):</label>
        <input type="number" name="rating" min="1" max="5" required><br>

        <label for="comment">Comment:</label>
        <textarea name="comment" rows="4" cols="50" required></textarea><br>

        <input type="submit" value="Submit Review">
    </form>
</body>
</html>
<?php
session_start();
include 'database_connection.php'; // Include your database connection code

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    // Validate input (e.g., check if the product_id exists)
    // ...

    // Insert the review into the database
    $query = "INSERT INTO reviews (product_id, rating, comment) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iis", $product_id, $rating, $comment);

    if ($stmt->execute()) {
        // Review inserted successfully
        header("Location: product_detail.php?id=$product_id"); // Redirect to a page that displays reviews
        exit();
    } else {
        // Handle the error
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
