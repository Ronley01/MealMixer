<?php
session_start();
require 'db.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Basic guard in case fields are empty
if ($username === '' || $password === '') {
    echo "Please enter both a username and password.";
    exit;
}

$stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    // Login success
    $_SESSION['username'] = $username;
    $_SESSION['user_id']  = $user['id'];

    header("Location: meals.php");
    exit;
} else {
    // Login failed
    echo "Invalid login.";
}
