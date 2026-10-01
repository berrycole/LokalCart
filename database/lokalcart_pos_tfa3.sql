-- Fresh LokalCart TFA3 database export. Import this file into MySQL.
CREATE DATABASE IF NOT EXISTS lokalcart_pos_tfa3 CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE lokalcart_pos_tfa3;

DROP TABLE IF EXISTS customers;
DROP TABLE IF EXISTS tasks;
DROP TABLE IF EXISTS users;

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'pending',
    task_date DATE NOT NULL,
    created_at DATETIME NOT NULL
);

CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(30) NOT NULL DEFAULT '',
    created_at DATETIME NOT NULL
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL DEFAULT '',
    avatar VARCHAR(255) NULL DEFAULT NULL,
    created_at DATETIME NOT NULL
);

INSERT INTO tasks (title, status, task_date, created_at) VALUES
('Review inventory counts', 'pending', CURDATE(), CONCAT(CURDATE(), ' 08:00:00')),
('Prepare morning sales summary', 'in progress', CURDATE(), CONCAT(CURDATE(), ' 08:30:00')),
('Confirm supplier delivery', 'pending', CURDATE(), CONCAT(CURDATE(), ' 09:00:00')),
('Update product descriptions', 'completed', DATE_ADD(CURDATE(), INTERVAL 1 DAY), NOW()),
('Check low-stock alerts', 'pending', DATE_ADD(CURDATE(), INTERVAL 1 DAY), NOW()),
('Organize receipt records', 'pending', DATE_ADD(CURDATE(), INTERVAL 2 DAY), NOW()),
('Plan weekend promotion', 'pending', DATE_ADD(CURDATE(), INTERVAL 2 DAY), NOW()),
('Review weekly targets', 'pending', DATE_SUB(CURDATE(), INTERVAL 1 DAY), NOW());

INSERT INTO customers (full_name, email, phone, created_at) VALUES
('Alex Rivera', 'alex.rivera@example.com', '09171234567', NOW()),
('Sam Cruz', 'sam.cruz@example.com', '', NOW());

INSERT INTO users (username, full_name, email, avatar, created_at) VALUES
('berry.cole', 'Berry Cole', 'berry.cole@example.com', NULL, NOW());
