-- ============================================================
-- SCC ReportHub – Complete Database Setup
-- Generated from Laravel Migrations + Seeders
-- ============================================================

SET FOREIGN_KEY_CHECKS = 0;

-- Drop tables if they exist (clean install)
DROP TABLE IF EXISTS `feedback`;
DROP TABLE IF EXISTS `notifications`;
DROP TABLE IF EXISTS `maintenance_logs`;
DROP TABLE IF EXISTS `tickets`;
DROP TABLE IF EXISTS `facilities`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `roles`;
DROP TABLE IF EXISTS `migrations`;

SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================
-- Create Database
-- ============================================================
CREATE DATABASE IF NOT EXISTS `scc_reporthub`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `scc_reporthub`;

-- ============================================================
-- Table: roles
-- ============================================================
CREATE TABLE `roles` (
  `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`       VARCHAR(255)    NOT NULL,
  `slug`       VARCHAR(255)    NOT NULL,
  `created_at` TIMESTAMP       NULL DEFAULT NULL,
  `updated_at` TIMESTAMP       NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- Table: users
-- ============================================================
CREATE TABLE `users` (
  `id`                BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id`           BIGINT UNSIGNED NOT NULL,
  `first_name`        VARCHAR(100)    NOT NULL,
  `last_name`         VARCHAR(100)    NOT NULL,
  `email`             VARCHAR(255)    NOT NULL,
  `email_verified_at` TIMESTAMP       NULL DEFAULT NULL,
  `password`          VARCHAR(255)    NOT NULL,
  `department`        VARCHAR(150)    NULL DEFAULT NULL,
  `specialization`    VARCHAR(255)    NULL DEFAULT NULL,
  `contact_number`    VARCHAR(20)     NULL DEFAULT NULL,
  `profile_photo`     VARCHAR(255)    NULL DEFAULT NULL,
  `status`            ENUM('active','inactive') NOT NULL DEFAULT 'active',
  `remember_token`    VARCHAR(100)    NULL DEFAULT NULL,
  `created_at`        TIMESTAMP       NULL DEFAULT NULL,
  `updated_at`        TIMESTAMP       NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign`
    FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- Table: facilities
-- ============================================================
CREATE TABLE `facilities` (
  `id`            BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `building_name` VARCHAR(150)    NOT NULL,
  `room_number`   VARCHAR(50)     NULL DEFAULT NULL,
  `floor`         VARCHAR(50)     NULL DEFAULT NULL,
  `description`   TEXT            NULL DEFAULT NULL,
  `created_at`    TIMESTAMP       NULL DEFAULT NULL,
  `updated_at`    TIMESTAMP       NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- Table: tickets
-- ============================================================
CREATE TABLE `tickets` (
  `id`             BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ticket_number`  VARCHAR(30)     NOT NULL,
  `user_id`        BIGINT UNSIGNED NOT NULL,
  `category_id`    BIGINT UNSIGNED NULL DEFAULT NULL,
  `location_id`    BIGINT UNSIGNED NULL DEFAULT NULL,
  `issue_category` ENUM('electrical','plumbing','structural','hvac','furniture','sanitation','network','others') NOT NULL DEFAULT 'others',
  `title`          VARCHAR(255)    NOT NULL,
  `description`    TEXT            NOT NULL,
  `priority_level` ENUM('urgent','high','normal') NOT NULL DEFAULT 'normal',
  `photo_path`     VARCHAR(255)    NULL DEFAULT NULL,
  `status`         ENUM('pending','approved','rejected','assigned','ongoing','resolved','completed') NOT NULL DEFAULT 'pending',
  `assigned_to`    BIGINT UNSIGNED NULL DEFAULT NULL,
  `approved_by`    BIGINT UNSIGNED NULL DEFAULT NULL,
  `approved_at`    TIMESTAMP       NULL DEFAULT NULL,
  `completed_at`   TIMESTAMP       NULL DEFAULT NULL,
  `created_at`     TIMESTAMP       NULL DEFAULT NULL,
  `updated_at`     TIMESTAMP       NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tickets_ticket_number_unique` (`ticket_number`),
  KEY `tickets_status_priority_level_index` (`status`, `priority_level`),
  KEY `tickets_user_id_index` (`user_id`),
  KEY `tickets_assigned_to_index` (`assigned_to`),
  KEY `tickets_location_id_foreign` (`location_id`),
  KEY `tickets_approved_by_foreign` (`approved_by`),
  CONSTRAINT `tickets_user_id_foreign`
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tickets_location_id_foreign`
    FOREIGN KEY (`location_id`) REFERENCES `facilities` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tickets_assigned_to_foreign`
    FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tickets_approved_by_foreign`
    FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- Table: maintenance_logs
-- ============================================================
CREATE TABLE `maintenance_logs` (
  `id`                   BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ticket_id`            BIGINT UNSIGNED NOT NULL,
  `maintenance_staff_id` BIGINT UNSIGNED NOT NULL,
  `action_taken`         TEXT            NOT NULL,
  `repair_notes`         TEXT            NULL DEFAULT NULL,
  `repair_cost`          DECIMAL(10,2)   NOT NULL DEFAULT 0.00,
  `materials_used`       TEXT            NULL DEFAULT NULL,
  `status`               ENUM('ongoing','resolved') NOT NULL DEFAULT 'ongoing',
  `created_at`           TIMESTAMP       NULL DEFAULT NULL,
  `updated_at`           TIMESTAMP       NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `maintenance_logs_ticket_id_foreign` (`ticket_id`),
  KEY `maintenance_logs_maintenance_staff_id_foreign` (`maintenance_staff_id`),
  CONSTRAINT `maintenance_logs_ticket_id_foreign`
    FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `maintenance_logs_maintenance_staff_id_foreign`
    FOREIGN KEY (`maintenance_staff_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- Table: notifications
-- ============================================================
CREATE TABLE `notifications` (
  `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id`    BIGINT UNSIGNED NOT NULL,
  `ticket_id`  BIGINT UNSIGNED NULL DEFAULT NULL,
  `message`    TEXT            NOT NULL,
  `type`       VARCHAR(50)     NOT NULL DEFAULT 'general',
  `is_read`    TINYINT(1)      NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP       NULL DEFAULT NULL,
  `updated_at` TIMESTAMP       NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_is_read_index` (`user_id`, `is_read`),
  KEY `notifications_ticket_id_foreign` (`ticket_id`),
  CONSTRAINT `notifications_user_id_foreign`
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `notifications_ticket_id_foreign`
    FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- Table: feedback
-- ============================================================
CREATE TABLE `feedback` (
  `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ticket_id`  BIGINT UNSIGNED NOT NULL,
  `user_id`    BIGINT UNSIGNED NOT NULL,
  `rating`     TINYINT UNSIGNED NOT NULL,
  `comment`    TEXT            NULL DEFAULT NULL,
  `created_at` TIMESTAMP       NULL DEFAULT NULL,
  `updated_at` TIMESTAMP       NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `feedback_ticket_id_unique` (`ticket_id`),
  KEY `feedback_user_id_foreign` (`user_id`),
  CONSTRAINT `feedback_ticket_id_foreign`
    FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `feedback_user_id_foreign`
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- Table: migrations (Laravel tracking)
-- ============================================================
CREATE TABLE `migrations` (
  `id`        INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) NOT NULL,
  `batch`     INT          NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- Seed: roles
-- ============================================================
INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Administrator',    'admin',       NOW(), NOW()),
(2, 'Faculty/Staff',    'faculty',     NOW(), NOW()),
(3, 'Maintenance Staff','maintenance', NOW(), NOW());

-- ============================================================
-- Seed: users (default accounts)
-- Passwords are bcrypt hashed
-- admin@scc.edu.ph        → Admin@1234
-- faculty@scc.edu.ph      → Faculty@1234
-- maintenance@scc.edu.ph  → Maintenance@1234
-- ============================================================
INSERT INTO `users` (`role_id`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `department`, `contact_number`, `status`, `created_at`, `updated_at`) VALUES
(1, 'System',  'Administrator', 'admin@scc.edu.ph',        NOW(), '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'IT Department',         '09000000001', 'active', NOW(), NOW()),
(2, 'Maria',   'Santos',        'faculty@scc.edu.ph',      NOW(), '$2y$12$TKh8H1.PFgs93R9Q3lhN5.3t3qVzVCdCx2Wnwpv5H/C/.og/at2.u', 'College of Education',  '09000000002', 'active', NOW(), NOW()),
(2, 'Juan',    'Dela Cruz',     'faculty2@scc.edu.ph',     NOW(), '$2y$12$TKh8H1.PFgs93R9Q3lhN5.3t3qVzVCdCx2Wnwpv5H/C/.og/at2.u', 'College of Business',   '09000000003', 'active', NOW(), NOW()),
(3, 'Pedro',   'Reyes',         'maintenance@scc.edu.ph',  NOW(), '$2y$12$TKh8H1.PFgs93R9Q3lhN5.3t3qVzVCdCx2Wnwpv5H/C/.og/at2.u', 'Facilities & Maintenance','09000000004','active', NOW(), NOW()),
(3, 'Carlos',  'Mendoza',       'maintenance2@scc.edu.ph', NOW(), '$2y$12$TKh8H1.PFgs93R9Q3lhN5.3t3qVzVCdCx2Wnwpv5H/C/.og/at2.u', 'Facilities & Maintenance','09000000005','active', NOW(), NOW());

-- ============================================================
-- Seed: facilities
-- ============================================================
INSERT INTO `facilities` (`building_name`, `room_number`, `floor`, `description`, `created_at`, `updated_at`) VALUES
('Main Building',       '101',  '1st Floor', 'Administration Office',  NOW(), NOW()),
('Main Building',       '201',  '2nd Floor', 'Faculty Room',           NOW(), NOW()),
('Main Building',       '301',  '3rd Floor', 'Conference Room',        NOW(), NOW()),
('Science Building',    '101',  '1st Floor', 'Chemistry Laboratory',   NOW(), NOW()),
('Science Building',    '102',  '1st Floor', 'Physics Laboratory',     NOW(), NOW()),
('Library Building',    NULL,   '1st Floor', 'Main Library',           NOW(), NOW()),
('Gymnasium',           NULL,   'Ground',    'Sports Gymnasium',       NOW(), NOW()),
('Computer Laboratory', '101',  '1st Floor', 'Computer Lab 1',         NOW(), NOW()),
('Computer Laboratory', '102',  '1st Floor', 'Computer Lab 2',         NOW(), NOW()),
('Chapel',              NULL,   'Ground',    'SCC Chapel',             NOW(), NOW()),
('Canteen',             NULL,   'Ground',    'School Canteen',         NOW(), NOW()),
('Dormitory',           NULL,   'Multiple',  'Student Dormitory',      NOW(), NOW());

-- ============================================================
-- Migration records
-- ============================================================
INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2024_01_01_000001_create_roles_table', 1),
('2024_01_01_000002_create_users_table', 1),
('2024_01_01_000003_create_facilities_table', 1),
('2024_01_01_000004_create_tickets_table', 1),
('2024_01_01_000005_create_maintenance_logs_table', 1),
('2024_01_01_000006_create_notifications_table', 1),
('2024_01_01_000007_create_feedback_table', 1),
('2024_01_01_000008_add_issue_category_to_tickets_table', 1),
('2024_01_01_000009_add_specialization_to_users_table', 1),
('2024_01_01_000010_add_email_verified_at_to_users_table', 1);

-- ============================================================
-- Default login credentials:
-- Admin:       admin@scc.edu.ph        / Admin@1234
-- Faculty:     faculty@scc.edu.ph      / Faculty@1234
-- Faculty 2:   faculty2@scc.edu.ph     / Faculty@1234
-- Maintenance: maintenance@scc.edu.ph  / Maintenance@1234
-- Maintenance2:maintenance2@scc.edu.ph / Maintenance@1234
-- ============================================================
