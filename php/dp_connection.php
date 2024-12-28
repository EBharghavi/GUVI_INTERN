<?php
// Database connection settings
$servername = "localhost";  // MySQL server (usually localhost)
$username = "root";         // MySQL username (default is root)
$password = "";             // MySQL password (default is empty for XAMPP)
$dbname = "guvi_intern";    // The name of your database (change if needed)

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
