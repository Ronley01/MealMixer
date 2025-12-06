<?php
session_start();
require_once "meals_data.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Meals | Meal Mixer</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<!-- TOP NAV -->
<header class="top-nav">
    <div class="nav-inner">
        <a href="index.php" class="nav-logo">Meal Mixer</a>
        <nav class="nav-links">
            <a href="meals.php">Meals</a>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="saved.php">Saved Meals</a>
                <a href="logout.php" class="nav-auth">Logout</a>
            <?php else: ?>
                <a href="login.php" class="nav-auth">Login</a>
                <a href="signup.php" class="nav-auth nav-signup">Sign Up</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<div class="meals-container">
    <div class="meals-header">
        <h1 class="meals-title">Meal Ideas</h1>
        <p class="meals-sub">Beginner-friendly meals using Panther Pantry ingredients.</p>
    </div>

    <div class="meals-grid">
        <?php foreach ($MEALS as $meal): ?>
            <div class="meal-card fade-in">

                <!-- IMAGE -->
                <img src="<?= $meal['image'] ?>" class="meal-img">

                <!-- TITLE -->
                <h2 class="meal-name"><?= htmlspecialchars($meal['title']) ?></h2>

                <!-- SHOW/HIDE BUTTON -->
                <button class="toggle-btn">Show Steps</button>

                <!-- STEPS SECTION -->
                <div class="meal-steps">

                    <h3>Ingredients</h3>
                    <ul>
                        <?php foreach ($meal['ingredients'] as $ing): ?>
                            <li><?= htmlspecialchars($ing) ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <h3>Tools Needed</h3>
                    <ul>
                        <?php foreach ($meal['tools'] as $tool): ?>
                            <li><?= htmlspecialchars($tool) ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <h3>Instructions</h3>
                    <ol>
                        <?php foreach ($meal['steps'] as $step): ?>
                            <li><?= htmlspecialchars($step) ?></li>
                        <?php endforeach; ?>
                    </ol>

                </div>

                <!-- ACTION BUTTONS -->
                <div class="meal-actions">

                    <!-- SAVE MEAL BUTTON (FIXED) -->
                    <button class="save-btn"
                            data-meal-id="<?= $meal['id'] ?>"
                            onclick="saveMeal('<?= $meal['id'] ?>')">
                        Save Meal
                    </button>

                    <!-- COPY INGREDIENTS -->
                    <button class="copy-btn"
                            onclick="copyIngredients(`<?= implode('\n', $meal['ingredients']) ?>`)">
                        Copy Ingredients
                    </button>

                </div>

            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- LOGIN MODAL -->
<div class="modal-overlay" id="loginModal">
    <div class="modal-box">
        <h2>Login Required</h2>
        <p>You must be logged in to save meals.</p>

        <div class="modal-actions">
            <a href="login.php" class="modal-btn login">Login</a>
            <a href="signup.php" class="modal-btn signup">Sign Up</a>
        </div>

        <button class="modal-close" onclick="closeModal()">Cancel</button>
    </div>
</div>

<script src="main.js"></script>

</body>
</html>

