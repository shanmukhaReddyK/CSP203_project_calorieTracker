<?php

$conn = new mysqli("localhost", "root", "", "calorie_tracker");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$current_date = date('Y-m-d');
if (!isset($_SESSION['last_reset']) || $_SESSION['last_reset'] !== $current_date) {
    // Clear old data
    $conn->query("DELETE FROM calories WHERE logged_at < CURDATE()");

    // Update the session variable
    $_SESSION['last_reset'] = $current_date;
}

$result = $conn->query("SELECT 
    SUM(CASE WHEN type = 'food' THEN calories ELSE 0 END) AS total_food,
    SUM(CASE WHEN type = 'workout' THEN calories ELSE 0 END) AS total_workout,
    SUM(protein) AS total_protein,
    SUM(fiber) AS total_fiber,
    SUM(carbs) AS total_carbs
FROM calories");
$data = $result->fetch_assoc();

$total_food = $data['total_food'] ?? 0;
$total_workout = $data['total_workout'] ?? 0;
$net_calories = $total_food - $total_workout;
$total_protein = $data['total_protein'] ?? 0;
$total_fiber = $data['total_fiber'] ?? 0;
$total_carbs = $data['total_carbs'] ?? 0;

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dailycal</title>
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>


    
       <h1>dailycal</h1> 
   

    <div class="bentobox">
        <div class="trackerdisplay">
           <div class="caltracker">       
                <p><strong>Net Calories:</strong> <?= $net_calories ?> kcal</p>
                <p><strong>Total Calories Burned:</strong> <?= $total_workout ?> kcal</p>
                <p><strong>Total Calories Consumed:</strong> <?= $total_food ?> kcal</p>
           </div>  
           <div class="macrotracker">
               <p><strong>Total Protein:</strong> <?= $total_protein ?> g</p>
               <p><strong>Total Fiber:</strong> <?= $total_fiber ?> g</p>
               <p><strong>Total Carbs:</strong> <?= $total_carbs ?> g</p>
           </div>
        </div>
        <div class="bentonav">
            <ul>
                <li><a href="./pages/foodlog.php">Log Food</a></li>
                <li><a href="./pages/workout.php">Log Workout</a></li>
            </ul>
        </div>
    </div>
    
</body>
</html>