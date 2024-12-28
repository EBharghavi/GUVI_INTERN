<?php
include('db_connection.php'); // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];

    // Check if the email already exists in the database
    $query = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // If email already exists, show error message
        echo "An account with this email already exists. Please <a href='../html/login.html'>login here</a>.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user data into the database
        $insert_query = "INSERT INTO user (username, email, password, dob, age, phone) 
                         VALUES ('$username', '$email', '$hashed_password', '$dob', '$age', '$phone')";

        if ($conn->query($insert_query) === TRUE) {
            echo "Registration successful! Please <a href='../html/login.html'>login here</a>.";
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }
}
?>

<!-- Registration form -->
<form method="POST" action="register.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <label for="dob">Date of Birth:</label>
    <input type="date" id="dob" name="dob" required>

    <label for="age">Age:</label>
    <input type="number" id="age" name="age" required>

    <label for="phone">Phone Number:</label>
    <input type="tel" id="phone" name="phone" required>

    <button type="submit">Register</button>
</form>
