-- Run against an existing TFA2 database to preserve its tasks and users.
USE lokalcart_pos_tfa2;

CREATE TABLE IF NOT EXISTS customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL DEFAULT '',
    created_at DATETIME NOT NULL
);

-- Older TSA2 databases did not include email; later TFA2 databases did.
SET @has_email = (SELECT COUNT(*) FROM information_schema.columns
    WHERE table_schema = DATABASE() AND table_name = 'users' AND column_name = 'email');
SET @add_email = IF(@has_email = 0,
    CONCAT('ALTER TABLE users ADD COLUMN email VARCHAR(100) NOT NULL DEFAULT ', QUOTE(''), ' AFTER full_name'),
    'SELECT 1');
PREPARE email_statement FROM @add_email;
EXECUTE email_statement;
DEALLOCATE PREPARE email_statement;

SET @has_avatar = (SELECT COUNT(*) FROM information_schema.columns
    WHERE table_schema = DATABASE() AND table_name = 'users' AND column_name = 'avatar');
SET @add_avatar = IF(@has_avatar = 0,
    'ALTER TABLE users ADD COLUMN avatar VARCHAR(255) NULL DEFAULT NULL AFTER email',
    'SELECT 1');
PREPARE avatar_statement FROM @add_avatar;
EXECUTE avatar_statement;
DEALLOCATE PREPARE avatar_statement;
