<?php
session_start();
require 'db.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Check if fields are empty
if ($username === '' || $password === '') {
    echo "Please enter a username and password.";
    exit;
}

// Check if username already exists
$check = $conn->prepare("SELECT id FROM users WHERE username = ?");
$check->bind_param("s", $username);
$check->execute();
$exists = $check->get_result();

if ($exists->num_rows > 0) {
    echo "This username is already taken.";
    exit;
}

// Insert the new user
$hashed_pass = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashed_pass);

if ($stmt->execute()) {
    // Auto-login after signup
    $_SESSION['username'] = $username;
    $_SESSION['user_id']  = $stmt->insert_id;

    header("Location: meals.php");
    exit;
} else {
    echo "Error creating account.";
}
?>
