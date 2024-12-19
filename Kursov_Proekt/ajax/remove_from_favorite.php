<?php
require_once('../db.php');  // Включете връзката с базата данни
session_start();

// Проверка дали потребителят е логнат
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Моля, влезте в профила си.']);
    exit;
}

$user_id = $_SESSION['user_id'];
$painting_id = $_POST['painting_id'] ?? 0; 

// Проверка за валидност на картината
if ($painting_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Невалидна картина.']);
    exit;
}

// Проверка дали картината съществува в любими
$query = "SELECT * FROM favorite_paintings WHERE user_id = :user_id AND painting_id = :painting_id";
$stmt = $pdo->prepare($query);
$stmt->execute([':user_id' => $user_id, ':painting_id' => $painting_id]);

if ($stmt->rowCount() == 0) {
    echo json_encode(['success' => false, 'message' => 'Тази картина не е в любими.']);
    exit;
}

// Премахваме картината от любими
$query = "DELETE FROM favorite_paintings WHERE user_id = :user_id AND painting_id = :painting_id";
$stmt = $pdo->prepare($query);

if ($stmt->execute([':user_id' => $user_id, ':painting_id' => $painting_id])) {
    echo json_encode(['success' => true, 'message' => 'Картината беше успешно премахната от любими.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Грешка при премахване от любими.']);
}
