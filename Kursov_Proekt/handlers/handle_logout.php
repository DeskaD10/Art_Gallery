<?php

// Премахване на всички данни от сесията
session_unset();
session_destroy();

// Flash съобщение за успешен logout
session_start();
$_SESSION['flash']['message'] = [
    'type' => 'success',
    'text' => 'Успешно излязохте от системата. Надяваме се скоро да ви видим отново!'
];

// Пренасочване към началната страница
header('Location: ../index.php');
exit;
