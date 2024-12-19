<?php
require_once('../db.php');
session_start();

// Проверка дали потребителят е логнат
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Моля, влезте в профила си.']);
    exit;
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'] ?? 'Неизвестен'; 
$painting_id = $_POST['painting_id'] ?? 0;

if ($painting_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Невалидна картина.']);
    exit;
}

// Вземаме заглавието на картината от базата данни
$query = "SELECT title FROM paintings WHERE id = :painting_id";
$stmt = $pdo->prepare($query);
$stmt->execute([':painting_id' => $painting_id]);
$painting = $stmt->fetch();

if (!$painting) {
    echo json_encode(['success' => false, 'message' => 'Не е намерена картина с такова ID.']);
    exit;
}

$painting_title = $painting['title'];

// Проверяваме дали картината вече е в любими
$query = "SELECT * FROM favorite_paintings WHERE user_id = :user_id AND painting_id = :painting_id";
$stmt = $pdo->prepare($query);
$stmt->execute([':user_id' => $user_id, ':painting_id' => $painting_id]);

if ($stmt->rowCount() > 0) {
    // Картината вече е в любими
    echo json_encode(['success' => false, 'message' => 'Тази картина вече е в любими.']);
    exit;
}

// Добавяне на картината в любими, включително името на потребителя и заглавието на картината
$query = "INSERT INTO favorite_paintings (user_id, user_name, painting_id, painting_title) 
          VALUES (:user_id, :user_name, :painting_id, :painting_title)";
$stmt = $pdo->prepare($query);
if ($stmt->execute([':user_id' => $user_id, ':user_name' => $user_name, ':painting_id' => $painting_id, ':painting_title' => $painting_title])) {
    echo json_encode(['success' => true, 'message' => 'Картината беше успешно добавена в любими.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Грешка при добавяне в любими.']);
}
