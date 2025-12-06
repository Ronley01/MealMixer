<?php
session_start();
require_once "db.php";

// User must be logged in
if (!isset($_SESSION['user_id'])) {
    echo "NOT_LOGGED_IN";
    exit;
}

if (!isset($_POST['meal_id'])) {
    echo "NO_MEAL_ID";
    exit;
}

$userId = $_SESSION['user_id'];
$mealId = $_POST['meal_id'];

// 1️⃣ Check if already saved
$check = $conn->prepare("SELECT id FROM saved_meals WHERE user_id = ? AND meal_id = ?");
$check->bind_param("is", $userId, $mealId);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo "ALREADY_SAVED";
    exit;
}

// 2️⃣ Insert new saved meal
$stmt = $conn->prepare("INSERT INTO saved_meals (user_id, meal_id) VALUES (?, ?)");
$stmt->bind_param("is", $userId, $mealId);

if ($stmt->execute()) {
    echo "SAVED";
} else {
    echo "ERROR";
}
