-- LokalCart Tasks for Today Management System database export.
CREATE DATABASE IF NOT EXISTS lokalcart_pos_tfa2 CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE lokalcart_pos_tfa2;
DROP TABLE IF EXISTS tasks;
DROP TABLE IF EXISTS users;
CREATE TABLE tasks (id INT AUTO_INCREMENT PRIMARY KEY, title VARCHAR(150) NOT NULL, status VARCHAR(20) NOT NULL DEFAULT 'pending', task_date DATE NOT NULL, created_at DATETIME NOT NULL);
CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(50) NOT NULL UNIQUE, full_name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL);
INSERT INTO tasks (title, status, task_date, created_at) VALUES
('Review inventory counts', 'pending', CURDATE(), CONCAT(CURDATE(), ' 08:00:00')),
('Prepare morning sales summary', 'in progress', CURDATE(), CONCAT(CURDATE(), ' 08:30:00')),
('Confirm supplier delivery', 'pending', CURDATE(), CONCAT(CURDATE(), ' 09:00:00')),
('Update product descriptions', 'completed', DATE_ADD(CURDATE(), INTERVAL 1 DAY), NOW()),
('Check low-stock alerts', 'pending', DATE_ADD(CURDATE(), INTERVAL 1 DAY), NOW()),
('Organize receipt records', 'pending', DATE_ADD(CURDATE(), INTERVAL 2 DAY), NOW()),
('Plan weekend promotion', 'pending', DATE_ADD(CURDATE(), INTERVAL 2 DAY), NOW()),
('Review weekly targets', 'pending', DATE_SUB(CURDATE(), INTERVAL 1 DAY), NOW());
INSERT INTO users (username, full_name, email, created_at) VALUES ('berry.cole', 'Berry Cole', 'berry.cole@example.com', NOW());
