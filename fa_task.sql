CREATE DATABASE IF NOT EXISTS fa_task
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE fa_task;

CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    UNIQUE KEY uq_users_email (email)
) ENGINE=InnoDB;

CREATE TABLE activity_events (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    event_type VARCHAR(50) NOT NULL,
    target VARCHAR(50) NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_activity_events_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE SET NULL,

    INDEX idx_activity_created_at (created_at),
    INDEX idx_activity_user_created (user_id, created_at),
    INDEX idx_activity_type_created (event_type, created_at),
    INDEX idx_activity_target_type_created (
        target,
        event_type,
        created_at
    )
) ENGINE=InnoDB;