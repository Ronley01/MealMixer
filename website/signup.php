<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up | Meal Mixer</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="auth-body">

<div class="auth-card fade-in">
    <h2>Create Account</h2>
    <p class="auth-sub">Save meals and revisit them anytime</p>

    <form action="signup_process.php" method="POST">
        <input type="text" name="username" class="auth-input" placeholder="Username" required>
        <input type="password" name="password" class="auth-input" placeholder="Password" required>

        <button class="auth-btn" type="submit">Sign Up</button>
    </form>

    <p class="auth-switch">Already have an account?
        <a href="login.php">Log In</a>
    </p>
</div>

</body>
</html>

