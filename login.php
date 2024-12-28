<?php
session_start();
include('db_connection.php'); // Include database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the email exists in the database
    $query = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($query);

    // Check if user exists
    if ($result->num_rows > 0) {
        // If user exists, fetch the user data
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Start a session and store the user ID
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username']; // Store username in session
            // Redirect to the profile page after successful login
            header("Location: ../html/profile.html");
            exit();
        } else {
            // If password is incorrect
            echo "Incorrect password. Please try again.";
        }
    } else {
        // If email does not exist in the database
        echo "No account found with this email. Please <a href='../html/register.html'>register here</a>.";
    }
}
?>

<!-- Login form -->
<form method="POST" action="login.php">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    
    <button type="submit">Login</button>
</form>
