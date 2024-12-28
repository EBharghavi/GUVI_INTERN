<?php
session_start();
include('db_connection.php'); // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../html/login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];

    // Update user profile data
    $update_query = "UPDATE user SET username='$username', age='$age', phone='$phone' WHERE id='$user_id'";

    if ($conn->query($update_query) === TRUE) {
        echo "Profile updated successfully.";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}

// Fetch current user data
$query = "SELECT * FROM user WHERE id='$user_id'";
$result = $conn->query($query);
$row = $result->fetch_assoc();

?>

<!-- Update Profile Form -->
<form method="POST" action="update-profile.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" required>

    <label for="age">Age:</label>
    <input type="number" id="age" name="age" value="<?php echo $row['age']; ?>" required>

    <label for="phone">Phone Number:</label>
    <input type="tel" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required>

    <button type="submit">Update Profile</button>
</form>
