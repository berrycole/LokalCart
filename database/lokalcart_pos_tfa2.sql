-- LokalCart POS Technical Formative Assessment 2 database export.
-- Import this file into a fresh local MySQL database using phpMyAdmin or MySQL.

CREATE DATABASE IF NOT EXISTS lokalcart_pos_tfa2
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;

USE lokalcart_pos_tfa2;

CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    created_at DATETIME NOT NULL
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    created_at DATETIME NOT NULL
);

INSERT INTO customers (full_name, email, phone, created_at) VALUES
    ('Mikaela Santos', 'mikaela.santos@example.com', '+63 917 420 1842', '2026-09-01 09:15:00'),
    ('Paolo Reyes', 'paolo.reyes@example.com', '+63 918 735 2096', '2026-09-02 10:30:00'),
    ('Alyssa Lim', 'alyssa.lim@example.com', '+63 905 641 3378', '2026-09-03 11:45:00'),
    ('Gabriel Cruz', 'gabriel.cruz@example.com', '+63 927 116 8504', '2026-09-04 13:00:00'),
    ('Nicole Mendoza', 'nicole.mendoza@example.com', '+63 916 802 4791', '2026-09-05 14:15:00'),
    ('Andre Villanueva', 'andre.villanueva@example.com', '+63 998 253 6610', '2026-09-06 15:30:00');

INSERT INTO users (username, full_name, created_at) VALUES
    ('admin.ramos', 'Elena Ramos', '2026-09-01 08:00:00'),
    ('manager.dizon', 'Carlo Dizon', '2026-09-02 08:30:00'),
    ('cashier.ong', 'Sofia Ong', '2026-09-03 09:00:00'),
    ('cashier.flores', 'Miguel Flores', '2026-09-04 09:30:00'),
    ('stock.garcia', 'Bea Garcia', '2026-09-05 10:00:00'),
    ('support.tan', 'Luis Tan', '2026-09-06 10:30:00');
