<style>
    form {
        background-color: #fff;
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    button[type="submit"] {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    a.back-link {
        display: inline-block;
        margin-top: 20px;
        text-decoration: none;
        color: #007bff;
    }

    a.back-link:hover {
        text-decoration: underline;
    }
</style>

<?php
include 'database_connection.php'; // Include the database connection file

if(isset($_GET['email']))
{
    $email = $_GET['email'];
    echo $email;

    $newPass = false;
    $errorMsg = "";

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) 
    {
        echo 'Submitted';
        $password = $_POST['psw'];
        $cpassword = $_POST['psw-repeat'];

        // Check if passwords match
        if($password != $cpassword)
        {
            echo "Passwords do not match.";
            exit();
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the SQL statement
        $sql = "UPDATE user SET Password = '$hashedPassword' WHERE Email='$email'";
    
        if(mysqli_query($conn, $sql))
        {
            echo 'Password updated successfully!';

        } else
        {
            echo 'Error updating password: ' . mysqli_error($conn);
        }
    }
}
// Close the database connection
$conn->close();
?>

<div class="modal-body">
<form action="newPass.php" method="POST">
    <label for="psw"><b>New Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

    <input type="submit" value="Create" name="create">
    <a href="index.php" data-dismiss="modal">Close</a>
</form>
</div>




