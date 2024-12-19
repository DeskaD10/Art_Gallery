<?php

require_once('../functions.php');
require_once('../db.php');

session_start(); // Уверяваме се, че сесията е стартирана

$error = '';

// Проверка за празни полета
foreach ($_POST as $key => $value) {
    if (empty(trim($value))) {
        $error = 'Моля, попълнете всички полета!';
        break;
    }
}

if ($error) {
    // Flash съобщение за грешка
    $_SESSION['flash']['message'] = [
        'type' => 'danger',
        'text' => $error
    ];
    $_SESSION['flash']['data'] = $_POST;
    header('Location: ../index.php?page=register');
    exit;
} 

$names = $_POST['names'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$repeat_password = $_POST['repeat_password'] ?? '';
$is_admin = intval($_POST['is_admin'] ?? 0);

// Проверка за съществуващ потребител с този email
$query = "SELECT id FROM users WHERE email = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user) {
    $error = 'Имейл адресът вече е регистриран!';
    $_SESSION['flash']['message'] = [
        'type' => 'danger',
        'text' => $error
    ];
    $_SESSION['flash']['data'] = $_POST;
    header('Location: ../index.php?page=register');
    exit;
}

// Проверка за валиден потребителски тип
if (!in_array($is_admin, [1, 2])) {
    $error = 'Невалиден тип потребител!';
    $_SESSION['flash']['message'] = [
        'type' => 'danger',
        'text' => $error
    ];
    $_SESSION['flash']['data'] = $_POST;
    header('Location: ../index.php?page=register');
    exit;
}

// Проверка дали паролите съвпадат
if ($password !== $repeat_password) {
    $error = 'Паролите не съвпадат!';
    $_SESSION['flash']['message'] = [
        'type' => 'danger',
        'text' => $error
    ];
    $_SESSION['flash']['data'] = $_POST;
    header('Location: ../index.php?page=register');
    exit;
}

// Хеширане на паролата
$hash = password_hash($password, PASSWORD_ARGON2I);

// Въвеждане на нов потребител в базата данни
$query = "INSERT INTO users (names, email, `password`, is_admin) VALUES (:names, :email, :hash, :is_admin)";
$stmt = $pdo->prepare($query);
$params = [
    ':names' => $names,
    ':email' => $email,
    ':hash' => $hash,
    ':is_admin' => $is_admin
];

if ($stmt->execute($params)) {
    $_SESSION['flash']['message'] = [
        'type' => 'success',
        'text' => 'Успешна регистрация! Моля, влезте в профила си.'
    ];
    header('Location: ../index.php?page=login');
    exit;
} else {
    $error = 'Възникна грешка при регистрацията!';
    $_SESSION['flash']['message'] = [
        'type' => 'danger',
        'text' => $error
    ];
    $_SESSION['flash']['data'] = $_POST;
    header('Location: ../index.php?page=register');
    exit;
}
?>
