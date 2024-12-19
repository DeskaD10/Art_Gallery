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
$name = $_POST['name'] ?? '';  
$email = $_POST['email'] ?? '';  
$subject = $_POST['subject'] ?? '';  
$message = $_POST['message'] ?? ''; 

// Проверка дали всички полета са попълнени
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'Моля, попълнете всички полета.']);
    exit;
}

// Подготовка на SQL заявката за добавяне на контакт в таблицата contacts
$query = "INSERT INTO contacts (user_id, user_name, name, email, subject, message) 
          VALUES (:user_id, :user_name, :name, :email, :subject, :message)";
$stmt = $pdo->prepare($query);

// Изпълняваме заявката
if ($stmt->execute([
    ':user_id' => $user_id, 
    ':user_name' => $user_name, 
    ':name' => $name, 
    ':email' => $email, 
    ':subject' => $subject, 
    ':message' => $message
])) {
    echo json_encode(['success' => true, 'message' => 'Контактът беше успешно добавен.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Грешка при добавяне на контакт.']);
}
?>
