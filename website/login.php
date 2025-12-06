<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Meal Mixer</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="auth-body">

<div class="auth-card fade-in">
    <h2>Welcome Back</h2>
    <p class="auth-sub">Log in to save your favorite meals</p>

    <?php if (isset($_GET['error'])): ?>
        <p style="color:red; font-weight:600;"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <form action="login_process.php" method="POST">
        <input type="text" name="username" class="auth-input" placeholder="Username" required>
        <input type="password" name="password" class="auth-input" placeholder="Password" required>

        <button class="auth-btn" type="submit">Log In</button>
    </form>

    <p class="auth-switch">Don’t have an account?
        <a href="signup.php">Sign Up</a>
    </p>
</div>

</body>
</html>
