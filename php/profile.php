<?php
session_start();
include('db_connection.php'); // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../html/login.html"); // Redirect to login page if not logged in
    exit();
}

$user_id = $_SESSION['user_id']; // Get the logged-in user's ID

// Fetch the user's current profile details
$query = "SELECT * FROM user WHERE id='$user_id'";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc(); // Store user details in an associative array
} else {
    echo "<p style='color:red;'>Error: User not found in the database.</p>";
    exit();
}

// Handle profile update submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Validate inputs
    if (empty($username) || empty($age) || empty($phone)) {
        echo "<p style='color:red;'>All fields are required.</p>";
    } else {
        // Update user details in the database
        $update_query = "UPDATE user SET username='$username', age='$age', phone='$phone' WHERE id='$user_id'";

        if ($conn->query($update_query) === TRUE) {
            echo "<p style='color:green;'>Profile updated successfully!</p>";
            // Refresh the page to show updated details
            header("Location: profile.php");
            exit();
        } else {
            echo "<p style='color:red;'>Error updating profile: " . $conn->error . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h1>

    <!-- Display user's current profile information -->
    <div>
        <h2>Your Profile</h2>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Age:</strong> <?php echo htmlspecialchars($user['age']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
    </div>

    <!-- Profile update form -->
    <h2>Update Your Profile</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($user['age']); ?>" required><br>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required><br>

        <button type="submit" name="update_profile">Update Profile</button>
    </form>

    <!-- Logout Option -->
    <form method="POST" action="logout.php">
        <button type="submit" name="logout">Logout</button>
    </form>
</body>
</html>
