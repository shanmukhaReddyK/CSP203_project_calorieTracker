<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $calories = intval($_POST['calories']);

    
    $conn = new mysqli("localhost", "root", "", "calorie_tracker");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO calories (type, calories) VALUES ('workout', ?)");
    $stmt->bind_param("i", $calories);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Workout</title>
</head>
<body>
    <h1>Log Workout</h1>
    <form method="POST">
        <label for="calories">Calories Burned:</label>
        <input type="number" name="calories" id="calories" required>
        <button type="submit">Log Workout</button>
    </form>
    <a href="../index.php">Back to Home</a>
</body>
</html>
