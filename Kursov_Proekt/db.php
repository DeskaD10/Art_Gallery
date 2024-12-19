<?php

try {
    $host = '127.0.0.1'; 
    $db   = 'gallery'; 
    $root = 'gallery_user';
    $pass = 'securepassword'; 
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
        PDO::ATTR_EMULATE_PREPARES   => false, 
    ];

    // Създаване на PDO обект за връзка с базата
    $pdo = new PDO($dsn, $root, $pass, $options);
} catch (PDOException $e) {
    echo 'Неуспешно свързване към базата данни: ' . $e->getMessage();
    exit;
} catch (Exception $e) {
    echo 'Възникна грешка: ' . $e->getMessage();
    exit;
}

?>
