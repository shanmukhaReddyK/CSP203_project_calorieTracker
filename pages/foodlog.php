<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $calories = intval($_POST['calories']);
    $protein = !empty($_POST['protein']) ? intval($_POST['protein']) : null;
    $fiber = !empty($_POST['fiber']) ? intval($_POST['fiber']) : null;
    $carbs = !empty($_POST['carbs']) ? intval($_POST['carbs']) : null;

   
    $conn = new mysqli("localhost", "root", "", "calorie_tracker");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO calories (type, calories, protein, fiber, carbs) VALUES ('food', ?, ?, ?, ?)");
    $stmt->bind_param("iiii", $calories, $protein, $fiber, $carbs);
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
    <title>Log Food</title>
    <link rel="stylesheet" href="../css/foodlog.css">
</head>
<body>
    <h1>Log Food</h1>
    <form method="POST">
        <label for="calories">Calories Consumed:</label>
        <input type="number" name="calories" id="calories" required><br>
        
        <label for="protein">Protein (g):</label>
        <input type="number" name="protein" id="protein"><br>
        
        <label for="fiber">Fiber (g):</label>
        <input type="number" name="fiber" id="fiber"><br>
        
        <label for="carbs">Carbs (g):</label>
        <input type="number" name="carbs" id="carbs"><br>

        <button type="submit">Log Food</button>
    </form>
    <a href="../index.php">Back to Home</a>
</body>
</html>
