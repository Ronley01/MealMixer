<?php
session_start();
require_once "db.php";

// User must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_POST['meal_id'])) {
    header("Location: saved.php");
    exit;
}

$userId = $_SESSION['user_id'];
$mealId = $_POST['meal_id'];

// Remove the saved meal
$stmt = $conn->prepare("DELETE FROM saved_meals WHERE user_id = ? AND meal_id = ?");
$stmt->bind_param("is", $userId, $mealId);
$stmt->execute();

header("Location: saved.php");
exit;
