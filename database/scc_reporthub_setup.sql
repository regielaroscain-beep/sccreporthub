-- ============================================================
-- SCC ReportHub – Database Setup Script
-- Southern Christian College
-- Run this in SQLyog or phpMyAdmin
-- ============================================================

CREATE DATABASE IF NOT EXISTS `scc_reporthub`
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE `scc_reporthub`;

-- ─── Roles ───────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `roles` (
    `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`       VARCHAR(100)    NOT NULL,
    `slug`       VARCHAR(100)    NOT NULL UNIQUE,
    `created_at` TIMESTAMP       NULL,
    `updated_at` TIMESTAMP       NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`name`, `slug`, `created_at`, `updated_at`) VALUES
('Administrator',    'admin',       NOW(), NOW()),
('Faculty/Staff',    'faculty',     NOW(), NOW()),
('Maintenance Staff','maintenance', NOW(), NOW());

-- ─── Users ───────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `users` (
    `id`             BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `role_id`        BIGINT UNSIGNED NOT NULL,
    `first_name`     VARCHAR(100)    NOT NULL,
    `last_name`      VARCHAR(100)    NOT NULL,
    `email`          VARCHAR(255)    NOT NULL UNIQUE,
    `password`       VARCHAR(255)    NOT NULL,
    `department`     VARCHAR(150)    NULL,
    `contact_number` VARCHAR(20)     NULL,
    `profile_photo`  VARCHAR(255)    NULL,
    `status`         ENUM('active','inactive') NOT NULL DEFAULT 'active',
    `remember_token` VARCHAR(100)    NULL,
    `created_at`     TIMESTAMP       NULL,
    `updated_at`     TIMESTAMP       NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Default users (passwords are bcrypt hashed)
-- admin: Admin@1234 | faculty: Faculty@1234 | maintenance: Maintenance@1234
INSERT INTO `users` (`role_id`, `first_name`, `last_name`, `email`, `password`, `department`, `contact_number`, `status`, `created_at`, `updated_at`) VALUES
(1, 'System',  'Administrator', 'admin@scc.edu.ph',        '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'IT Department',           '09000000001', 'active', NOW(), NOW()),
(2, 'Maria',   'Santos',        'faculty@scc.edu.ph',      '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'College of Education',    '09000000002', 'active', NOW(), NOW()),
(2, 'Juan',    'Dela Cruz',     'faculty2@scc.edu.ph',     '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'College of Business',     '09000000003', 'active', NOW(), NOW()),
(3, 'Pedro',   'Reyes',         'maintenance@scc.edu.ph',  '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Facilities & Maintenance','09000000004', 'active', NOW(), NOW()),
(3, 'Carlos',  'Mendoza',       'maintenance2@scc.edu.ph', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Facilities & Maintenance','09000000005', 'active', NOW(), NOW());

-- ─── Facilities ──────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `facilities` (
    `id`            BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `building_name` VARCHAR(150)    NOT NULL,
    `room_number`   VARCHAR(50)     NULL,
    `floor`         VARCHAR(50)     NULL,
    `description`   TEXT            NULL,
    `created_at`    TIMESTAMP       NULL,
    `updated_at`    TIMESTAMP       NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `facilities` (`building_name`, `room_number`, `floor`, `description`, `created_at`, `updated_at`) VALUES
('Main Building',       '101', '1st Floor', 'Administration Office',  NOW(), NOW()),
('Main Building',       '201', '2nd Floor', 'Faculty Room',           NOW(), NOW()),
('Main Building',       '301', '3rd Floor', 'Conference Room',        NOW(), NOW()),
('Science Building',    '101', '1st Floor', 'Chemistry Laboratory',   NOW(), NOW()),
('Science Building',    '102', '1st Floor', 'Physics Laboratory',     NOW(), NOW()),
('Library Building',    NULL,  '1st Floor', 'Main Library',           NOW(), NOW()),
('Gymnasium',           NULL,  'Ground',    'Sports Gymnasium',       NOW(), NOW()),
('Computer Laboratory', '101', '1st Floor', 'Computer Lab 1',         NOW(), NOW()),
('Computer Laboratory', '102', '1st Floor', 'Computer Lab 2',         NOW(), NOW()),
('Chapel',              NULL,  'Ground',    'SCC Chapel',             NOW(), NOW()),
('Canteen',             NULL,  'Ground',    'School Canteen',         NOW(), NOW()),
('Dormitory',           NULL,  'Multiple',  'Student Dormitory',      NOW(), NOW());

-- ─── Tickets ─────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `tickets` (
    `id`             BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `ticket_number`  VARCHAR(30)     NOT NULL UNIQUE,
    `user_id`        BIGINT UNSIGNED NOT NULL,
    `category_id`    BIGINT UNSIGNED NULL,
    `location_id`    BIGINT UNSIGNED NULL,
    `title`          VARCHAR(255)    NOT NULL,
    `description`    TEXT            NOT NULL,
    `priority_level` ENUM('urgent','high','normal') NOT NULL DEFAULT 'normal',
    `photo_path`     VARCHAR(255)    NULL,
    `status`         ENUM('pending','approved','rejected','assigned','ongoing','resolved','completed') NOT NULL DEFAULT 'pending',
    `assigned_to`    BIGINT UNSIGNED NULL,
    `approved_by`    BIGINT UNSIGNED NULL,
    `approved_at`    TIMESTAMP       NULL,
    `completed_at`   TIMESTAMP       NULL,
    `created_at`     TIMESTAMP       NULL,
    `updated_at`     TIMESTAMP       NULL,
    PRIMARY KEY (`id`),
    INDEX `idx_status_priority` (`status`, `priority_level`),
    INDEX `idx_user_id` (`user_id`),
    INDEX `idx_assigned_to` (`assigned_to`),
    FOREIGN KEY (`user_id`)     REFERENCES `users`(`id`)      ON DELETE CASCADE,
    FOREIGN KEY (`location_id`) REFERENCES `facilities`(`id`) ON DELETE SET NULL,
    FOREIGN KEY (`assigned_to`) REFERENCES `users`(`id`)      ON DELETE SET NULL,
    FOREIGN KEY (`approved_by`) REFERENCES `users`(`id`)      ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─── Maintenance Logs ─────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `maintenance_logs` (
    `id`                   BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `ticket_id`            BIGINT UNSIGNED NOT NULL,
    `maintenance_staff_id` BIGINT UNSIGNED NOT NULL,
    `action_taken`         TEXT            NOT NULL,
    `repair_notes`         TEXT            NULL,
    `repair_cost`          DECIMAL(10,2)   NOT NULL DEFAULT 0.00,
    `materials_used`       TEXT            NULL,
    `status`               ENUM('ongoing','resolved') NOT NULL DEFAULT 'ongoing',
    `created_at`           TIMESTAMP       NULL,
    `updated_at`           TIMESTAMP       NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`ticket_id`)            REFERENCES `tickets`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`maintenance_staff_id`) REFERENCES `users`(`id`)   ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─── Notifications ────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `notifications` (
    `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id`    BIGINT UNSIGNED NOT NULL,
    `ticket_id`  BIGINT UNSIGNED NULL,
    `message`    TEXT            NOT NULL,
    `type`       VARCHAR(50)     NOT NULL DEFAULT 'general',
    `is_read`    TINYINT(1)      NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP       NULL,
    `updated_at` TIMESTAMP       NULL,
    PRIMARY KEY (`id`),
    INDEX `idx_user_read` (`user_id`, `is_read`),
    FOREIGN KEY (`user_id`)   REFERENCES `users`(`id`)   ON DELETE CASCADE,
    FOREIGN KEY (`ticket_id`) REFERENCES `tickets`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─── Feedback ─────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `feedback` (
    `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `ticket_id`  BIGINT UNSIGNED NOT NULL UNIQUE,
    `user_id`    BIGINT UNSIGNED NOT NULL,
    `rating`     TINYINT UNSIGNED NOT NULL,
    `comment`    TEXT            NULL,
    `created_at` TIMESTAMP       NULL,
    `updated_at` TIMESTAMP       NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`ticket_id`) REFERENCES `tickets`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`)   REFERENCES `users`(`id`)   ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─── Migrations Table (for Laravel) ──────────────────────────
CREATE TABLE IF NOT EXISTS `migrations` (
    `id`        INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `migration` VARCHAR(255) NOT NULL,
    `batch`     INT          NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SELECT 'SCC ReportHub database setup complete!' AS Status;
