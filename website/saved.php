<?php
session_start();
require_once "db.php";
require_once "meals_data.php";

// Must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];

// Fetch saved meal IDs
$stmt = $conn->prepare("SELECT meal_id FROM saved_meals WHERE user_id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

// Convert saved IDs into full meal data
$savedMeals = [];

while ($row = $result->fetch_assoc()) {
    $savedId = $row['meal_id'];

    // Find meal by matching 'id' field
    foreach ($MEALS as $meal) {
        if ($meal['id'] === $savedId) {
            $savedMeals[] = $meal;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saved Meals | Meal Mixer</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<!-- TOP NAV -->
<div class="top-nav">
    <div class="nav-inner">
        <a href="index.php" class="nav-logo">Meal Mixer</a>

        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="meals.php">Meals</a>
            <a href="logout.php" class="logout-btn">Logout (<?= htmlspecialchars($_SESSION['username']) ?>)</a>
        </div>
    </div>
</div>

<div class="meals-container">
    <div class="meals-header">
        <h1 class="meals-title">Saved Meals</h1>
    </div>

    <?php if (empty($savedMeals)): ?>
        <p style="text-align:center; margin-top:20px; color:#444; font-size:1.2rem;">
            You haven't saved any meals yet.
        </p>

    <?php else: ?>

        <div class="meals-grid">

            <?php foreach ($savedMeals as $meal): ?>
                <div class="meal-card fade-in">

                    <img src="<?= $meal['image'] ?>" class="meal-img">

                    <h2 class="meal-name"><?= htmlspecialchars($meal['title']) ?></h2>

                    <form action="remove_saved.php" method="POST" style="margin-top:15px;">
                        <input type="hidden" name="meal_id" value="<?= $meal['id'] ?>">
                        <button class="save-btn" style="background:#b33a3a; color:white;">
                            Remove
                        </button>
                    </form>

                </div>
            <?php endforeach; ?>

        </div>

    <?php endif; ?>
</div>

</body>
</html>
