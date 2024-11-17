<?php
$conn = new mysqli("localhost", "root", "", "calorie_tracker");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Move old data to archive table
$conn->query("INSERT INTO calories_archive SELECT * FROM calories WHERE logged_at < CURDATE()");

// Clear old data from the main table
$conn->query("DELETE FROM calories WHERE logged_at < CURDATE()");

$conn->close();
?>

