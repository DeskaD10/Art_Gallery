-- phpMyAdmin SQL Dump
-- version 5.2.0
-- Theme: Галерия Арт Онлайн
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Database: `gallery`

CREATE TABLE `artists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `paintings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_sold` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`artist_id`) REFERENCES `artists`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE artworks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    artist_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    price DECIMAL(10, 2),
    FOREIGN KEY (artist_id) REFERENCES artists(id) ON DELETE CASCADE
);

CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL, 
    user_name VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    names VARCHAR(255) NOT NULL,         -- Име на потребителя
    email VARCHAR(255) NOT NULL UNIQUE,  -- Уникален имейл адрес
    password VARCHAR(255) NOT NULL,      -- Хеширана парола
    is_admin TINYINT(1) DEFAULT 0,       -- 0 = обикновен потребител, 1 = администратор
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Дата на регистрация
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Последна промяна
);

CREATE TABLE `exhibition_paintings` (
  `exhibition_id` int(11) NOT NULL,
  `painting_id` int(11) NOT NULL,
  PRIMARY KEY (`exhibition_id`, `painting_id`),
  FOREIGN KEY (`exhibition_id`) REFERENCES `exhibitions`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`painting_id`) REFERENCES `paintings`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- INSERT INTO `artists` (`id`, `name`, `bio`, `image`) VALUES
-- (1, 'Винсент ван Гог', 'Холандски художник, известен с изразителните си произведения.', 'https://example.com/van-gogh.jpg'),
-- (2, 'Леонардо да Винчи', 'Италиански ренесансов художник и изобретател.', 'https://example.com/da-vinci.jpg');

-- INSERT INTO `paintings` (`id`, `title`, `artist_id`, `price`, `image`, `is_sold`) VALUES
-- (1, 'Звездна нощ', 1, 500000.00, 'https://example.com/starry-night.jpg', 0),
-- (2, 'Мона Лиза', 2, 750000.00, 'https://example.com/mona-lisa.jpg', 0);

-- INSERT INTO `exhibitions` (`id`, `title`, `description`, `date`, `location`) VALUES
-- (1, 'Ренесансови шедьоври', 'Изложба на класическото изкуство.', '2024-12-20 18:00:00', 'София, България'),
-- (2, 'Импресионизъм и модернизъм', 'Изложба на модерното изкуство.', '2025-01-15 19:00:00', 'Пловдив, България');

-- INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
-- (1, 'Петър Иванов', 'peter@example.com', '$argon2i$v=19$m=65536,t=4,p=1$hashed_password'),
-- (2, 'Мария Петрова', 'maria@example.com', '$argon2i$v=19$m=65536,t=4,p=1$hashed_password');

-- INSERT INTO `exhibition_paintings` (`exhibition_id`, `painting_id`) VALUES
-- (1, 1),
-- (1, 2),
-- (2, 1);
