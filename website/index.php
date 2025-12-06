<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Meal Mixer | Panther Pantry</title>
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

<!-- HERO -->
<section class="hero-body">
    <div class="hero-overlay"></div>

    <div class="hero-content fade-in">
        <h1 class="hero-title">Meal Mixer</h1>

        <p class="hero-subtitle">
            Turn Panther Pantry ingredients into simple, delicious meals.
        </p>

        <a href="meals.php" class="hero-btn gold">Browse Meals</a>

        <div class="scroll-down-btn"
             onclick="window.scrollTo({ top: window.innerHeight, behavior: 'smooth' })">
            <div class="scroll-circle">
                <span class="scroll-arrow">↓</span>
            </div>
            <p class="scroll-label">Scroll Down</p>
        </div>
    </div>
</section>

<!-- WHAT IS MEAL MIXER -->
<section class="home-section fade-in">
    <h2 class="section-title">What is Meal Mixer?</h2>
    <p class="section-text">
        Meal Mixer helps SUNY Old Westbury students transform basic pantry staples into real meals. 
        Whether you're living on a budget, learning to cook, or simply need quick ideas,
        we turn what’s available at the Panther Pantry into step-by-step beginner-friendly recipes.
    </p>
</section>

<!-- HOW IT WORKS -->
<section class="home-section fade-in">
    <h2 class="section-title">How It Works</h2>

    <div class="how-grid">
        <div class="how-card">
            <h3>1. Browse Meals</h3>
            <p>Explore meals built entirely from Panther Pantry ingredients.</p>
        </div>

        <div class="how-card">
            <h3>2. Follow Simple Steps</h3>
            <p>Beginner-friendly instructions with exact times and tools.</p>
        </div>

        <div class="how-card">
            <h3>3. Save Favorites</h3>
            <p>Log in anytime to save and revisit meals you want to cook.</p>
        </div>
    </div>
</section>

<!-- WHY IT HELPS -->
<section class="home-section fade-in">
    <h2 class="section-title">Why Students Love Meal Mixer</h2>

    <ul class="benefits-list">
        <li>✔ Uses ingredients you already have access to</li>
        <li>✔ Saves time and money — no extra shopping</li>
        <li>✔ Perfect for beginners</li>
        <li>✔ Easy step-by-step guides</li>
        <li>✔ Completely free for students</li>
    </ul>
</section>

<!-- FEATURED MEALS -->
<section class="home-section fade-in">
    <h2 class="section-title">Featured Meals</h2>

    <div class="featured-grid">
        <?php 
        require_once __DIR__ . '/meals_data.php';
        $featured = array_slice($MEALS, 0, 3);
        foreach ($featured as $meal): 
        ?>
            <div class="featured-card">
                <img src="<?= $meal['image'] ?>" class="featured-img">
                <h3 class="featured-name"><?= htmlspecialchars($meal['title']) ?></h3>
                <a href="meals.php" class="featured-btn">View Meal</a>
            </div>
        <?php endforeach; ?>
    </div>

    <div style="text-align:center; margin-top:20px;">
        <a href="meals.php" class="hero-btn gold">See All Meals</a>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <p>Meal Mixer • Panther Pantry • SUNY Old Westbury</p>
</footer>

<script src="main.js"></script>
</body>
</html>
