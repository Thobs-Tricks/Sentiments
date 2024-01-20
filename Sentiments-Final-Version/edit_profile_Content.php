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

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
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
include 'database_connection.php';

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

// Handle password change when the "Change Password" button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_password'])) {
    // Get the current user's email
    $email = $_SESSION['email'];

    // Get the current password from the form
    $currentPassword = $_POST['current_password'];

    // Validate the current password against the stored password in the database
    $validatePasswordSql = "SELECT Password FROM user WHERE Email = ?";
    $stmt = $conn->prepare($validatePasswordSql);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $storedPassword = $row['Password'];

        // Verify if the entered current password matches the stored password
        if (password_verify($currentPassword, $storedPassword)) {
            // Current password is valid, proceed with changing the password
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            // Check if the new password and confirm password match
            if ($newPassword == $confirmPassword) {
                // Hash the new password
                $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Update the password in the database
                $updatePasswordSql = "UPDATE user SET Password = ? WHERE Email = ?";
                $stmt = $conn->prepare($updatePasswordSql);
                $stmt->bind_param("ss", $newHashedPassword, $email);

                if ($stmt->execute()) {
                    // Password changed successfully
                    $passwordChangeSuccess = true;
                } else {
                    $passwordChangeError = "Error updating password: " . $stmt->error;
                }

                $stmt->close();
            } else {
                $passwordChangeError = "New password and confirm password do not match.";
            }
        } else {
            $passwordChangeError = "Current password is incorrect.";
        }
    } else {
        echo "Error: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    // Get the current user's email
    $email = $_SESSION['email'];

    // Get updated user information from the form
    $newFirstName = $_POST['new_first_name'];
    $newLastName = $_POST['new_last_name'];
    $newEmail = $_POST['new_email'];
    $newAddress = $_POST['new_address'];
    $newPhone = $_POST['new_phone'];
    $newGender = $_POST['new_gender'];
    $newDOB = $_POST['new_dob'];

    // Update the user information in the database
    $updateProfileSql = "UPDATE user SET F_Name = ?, L_Name = ?, Email = ?, Address = ?, Phone = ?, Gender = ?, DOB = ? WHERE Email = ?";
    $stmt = $conn->prepare($updateProfileSql);
    $stmt->bind_param("ssssssss", $newFirstName, $newLastName, $newEmail, $newAddress, $newPhone, $newGender, $newDOB, $email);

    if ($stmt->execute()) {
        // Profile updated successfully
        $profileUpdateSuccess = true;

        // Update the session email if the email was changed
        if ($newEmail !== $email) {
            $_SESSION['email'] = $newEmail;
        }
    } else {
        $profileUpdateError = "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
}


// Retrieve the current profile information from the database
$email = $_SESSION['email'];
$sql = "SELECT F_Name, L_Name, Email, Address, Phone, Gender, DOB FROM user WHERE Email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $currentFirstName = $row['F_Name'];
    $currentLastName = $row['L_Name'];
    $currentEmail = $row['Email'];
    $currentAddress = $row['Address'];
    $currentPhone = $row['Phone'];
    $currentGender = $row['Gender'];
    $currentDOB = $row['DOB'];
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
</head>
<body>
    <h1>Edit Profile</h1>

    <?php if (isset($passwordChangeSuccess)) { ?>
        <p>Password changed successfully.</p>
    <?php } ?>

    <?php if (isset($passwordChangeError)) { ?>
        <p><?php echo $passwordChangeError; ?></p>
    <?php } ?>

    <!-- Profile information form -->
    <form method="POST" action="edit_profile.php">
        <label for="new_first_name">First Name:</label>
        <input type="text" id="new_first_name" name="new_first_name" value="<?php echo $currentFirstName; ?>" required>
        <br>

        <label for="new_last_name">Last Name:</label>
        <input type="text" id="new_last_name" name="new_last_name" value="<?php echo $currentLastName; ?>" required>
        <br>

        <label for="new_email">Email:</label>
        <input type="email" id="new_email" name="new_email" value="<?php echo $currentEmail; ?>" required>
        <br>

        <label for="new_address">Address:</label>
        <input type="text" id="new_address" name="new_address" value="<?php echo $currentAddress; ?>">
        <br>

        <label for="new_phone">Phone:</label>
        <input type="text" id="new_phone" name="new_phone" value="<?php echo $currentPhone; ?>" required>
        <br>

        <label for="new_gender">Gender:</label>
        <select id="new_gender" name="new_gender" required>
            <option value="male" <?php if ($currentGender == 'male') echo 'selected'; ?>>Male</option>
            <option value="female" <?php if ($currentGender == 'female') echo 'selected'; ?>>Female</option>
            <option value="N/A" <?php if ($currentGender == 'N/A') echo 'selected'; ?>>Prefer Not To Respond</option>
        </select>
        <br>

        <label for="new_dob">Date Of Birth:</label>
        <input type="date" id="new_dob" name="new_dob" value="<?php echo $currentDOB; ?>">
        <br>

        <button type="submit" name="update_profile">Update Profile</button>
    </form>

    <!-- Change Password form -->
    <form method="POST" action="edit_profile.php">
        <label for="current_password">Current Password:</label>
        <input type="password" id="current_password" name="current_password" required>
        <br>

        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>
        <br>

        <label for="confirm_password">Confirm New Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <br>

        <button type="submit" name="change_password">Change Password</button>
    </form>

    <br>
    <a href="profile.php">Back to Profile</a>
</body>
</html>
