<?php
// functions.php

function debug($data, $die = false) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';

    if ($die) {
        die;
    }
}

// Проверка дали потребителят е администратор
function is_admin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
}

// Генерира съкратено описание на картина
function generate_summary($text, $length = 150) {
    if (mb_strlen($text) <= $length) {
        return $text;
    }
    return mb_substr($text, 0, $length) . '...';
}

// Форматиране на цена с валутен символ
function format_price($price) {
    return number_format($price, 2, '.', '') . ' лв.';
}



?>
