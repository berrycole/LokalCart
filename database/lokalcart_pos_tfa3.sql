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
    phone VARCHAR(20) NOT NULL DEFAULT '',
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
('Mikaela Santos', 'mikaela.santos@example.com', '+63 917 420 1842', '2026-09-01 09:15:00'),
('Paolo Reyes', 'paolo.reyes@example.com', '+63 918 735 2096', '2026-09-02 10:30:00'),
('Alyssa Lim', 'alyssa.lim@example.com', '+63 905 641 3378', '2026-09-03 11:45:00'),
('Gabriel Cruz', 'gabriel.cruz@example.com', '+63 927 116 8504', '2026-09-04 13:00:00'),
('Nicole Mendoza', 'nicole.mendoza@example.com', '+63 916 802 4791', '2026-09-05 14:15:00'),
('Andre Villanueva', 'andre.villanueva@example.com', '+63 998 253 6610', '2026-09-06 15:30:00');

INSERT INTO users (username, full_name, email, avatar, created_at) VALUES
('admin.ramos', 'Elena Ramos', 'elena.ramos@example.com', NULL, '2026-09-01 08:00:00'),
('manager.dizon', 'Carlo Dizon', 'carlo.dizon@example.com', NULL, '2026-09-02 08:30:00'),
('cashier.ong', 'Sofia Ong', 'sofia.ong@example.com', NULL, '2026-09-03 09:00:00'),
('cashier.flores', 'Miguel Flores', 'miguel.flores@example.com', NULL, '2026-09-04 09:30:00'),
('stock.garcia', 'Bea Garcia', 'bea.garcia@example.com', NULL, '2026-09-05 10:00:00'),
('support.tan', 'Luis Tan', 'luis.tan@example.com', NULL, '2026-09-06 10:30:00');
