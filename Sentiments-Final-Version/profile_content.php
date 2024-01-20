<style>
        /* Basic styling for the profile page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .UserInfo {
            background-color: #fff;
            max-width: 800px; /* Increase the max-width to make the container larger */
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

         h2 {
            color: #333;
            font-size: 30px; 
        }

        p {
            margin: 10px 0;
            font-size: 25px; /* Increase the font size for paragraphs */
        }

        a.button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }

        a.button:hover {
            background-color: #0056b3;
        }
    </style>
    <?php
            include 'database_connection.php'; // Include your database connection file

            // Retrieve user information from the database
            if (isset($_SESSION['email'])) {
                $email = $_SESSION['email'];
                $sql = "SELECT F_Name, L_Name, Email, Address, Phone, Gender, DOB FROM user WHERE Email = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $email);

                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    $user = $result->fetch_assoc();

                    // Display user information
                    echo '<div class ="UserInfo">';
                    echo "<h2>Welcome, " . $user['F_Name'] . " " . $user['L_Name'] . "!</h2>";
                    echo "<p><b>Email:</b> " . $user['Email'] . "</p>";
                    echo "<p><b>Address:</b> " . $user['Address'] . "</p>";
                    echo "<p><b>Phone: </b>" . $user['Phone'] . "</p>";
                    echo "<p><b>Gender: </b>" . $user['Gender'] . "</p>";
                    echo "<p><b>Date of Birth: </b>" . $user['DOB'] . "</p>";

                    // Add an Edit Profile button that redirects to an edit profile page
                    echo '<a class="button" href="edit_profile.php">Edit Profile</a>';

                    echo '</div>';
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
               
            } else {
                echo "<p>Please log in to view your profile.</p>";
            }
            ?>