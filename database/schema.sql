SET FOREIGN_KEY_CHECKS = 0;

-- create table email_sents 
CREATE TABLE IF NOT EXISTS `email_sents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `to` text COLLATE utf8_unicode_ci,
  `subject` text COLLATE utf8_unicode_ci,
  `body` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- create table emails 
CREATE TABLE IF NOT EXISTS `emails` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `params` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- create table migrations 
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- create table password_resets 
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- create table settings 
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- create table tevep_invites 
CREATE TABLE IF NOT EXISTS `tevep_invites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tevep_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('accepted','denied') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'accepted|rejected',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tevep_invites_teveps` (`tevep_id`),
  KEY `FK_tevep_invites_users` (`user_id`),
  CONSTRAINT `FK_tevep_invites_teveps` FOREIGN KEY (`tevep_id`) REFERENCES `teveps` (`id`),
  CONSTRAINT `FK_tevep_invites_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- create table teveps 
CREATE TABLE IF NOT EXISTS `teveps` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta` longtext COLLATE utf8_unicode_ci,
  `date_start` text COLLATE utf8_unicode_ci,
  `date_final` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_teveps_users` (`user_id`),
  KEY `FK_teveps_teveps` (`parent`),
  CONSTRAINT `FK_teveps_teveps` FOREIGN KEY (`parent`) REFERENCES `teveps` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_teveps_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- create table user_notifications 
CREATE TABLE IF NOT EXISTS `user_notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `image` text COLLATE utf8mb4_unicode_ci,
  `seen` int(11) DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- create table users 
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified_at` text COLLATE utf8_unicode_ci,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta` text COLLATE utf8_unicode_ci,
  `level` enum('admin') COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- create field 'id' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `email_sents` ADD COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field id 
ALTER TABLE `email_sents` MODIFY COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;

-- create field 'to' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `email_sents` ADD COLUMN `to` text NULL DEFAULT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field to 
ALTER TABLE `email_sents` MODIFY COLUMN `to` text NULL DEFAULT NULL;

-- create field 'subject' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `email_sents` ADD COLUMN `subject` text NULL DEFAULT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field subject 
ALTER TABLE `email_sents` MODIFY COLUMN `subject` text NULL DEFAULT NULL;

-- create field 'body' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `email_sents` ADD COLUMN `body` text NULL DEFAULT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field body 
ALTER TABLE `email_sents` MODIFY COLUMN `body` text NULL DEFAULT NULL;

-- create field 'created_at' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `email_sents` ADD COLUMN `created_at` timestamp NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field created_at 
ALTER TABLE `email_sents` MODIFY COLUMN `created_at` timestamp NULL;

-- create field 'updated_at' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `email_sents` ADD COLUMN `updated_at` timestamp NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field updated_at 
ALTER TABLE `email_sents` MODIFY COLUMN `updated_at` timestamp NULL;

-- create field 'id' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `emails` ADD COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field id 
ALTER TABLE `emails` MODIFY COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;

-- create field 'name' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `emails` ADD COLUMN `name` varchar(255) NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field name 
ALTER TABLE `emails` MODIFY COLUMN `name` varchar(255) NULL;

-- create field 'subject' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `emails` ADD COLUMN `subject` varchar(255) NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field subject 
ALTER TABLE `emails` MODIFY COLUMN `subject` varchar(255) NULL;

-- create field 'body' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `emails` ADD COLUMN `body` text NULL DEFAULT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field body 
ALTER TABLE `emails` MODIFY COLUMN `body` text NULL DEFAULT NULL;

-- create field 'params' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `emails` ADD COLUMN `params` text NULL DEFAULT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field params 
ALTER TABLE `emails` MODIFY COLUMN `params` text NULL DEFAULT NULL;

-- create field 'created_at' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `emails` ADD COLUMN `created_at` timestamp NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field created_at 
ALTER TABLE `emails` MODIFY COLUMN `created_at` timestamp NULL;

-- create field 'updated_at' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `emails` ADD COLUMN `updated_at` timestamp NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field updated_at 
ALTER TABLE `emails` MODIFY COLUMN `updated_at` timestamp NULL;

-- create field 'id' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `migrations` ADD COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field id 
ALTER TABLE `migrations` MODIFY COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;

-- create field 'migration' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `migrations` ADD COLUMN `migration` varchar(255) NOT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field migration 
ALTER TABLE `migrations` MODIFY COLUMN `migration` varchar(255) NOT NULL;

-- create field 'batch' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `migrations` ADD COLUMN `batch` int(11) NOT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field batch 
ALTER TABLE `migrations` MODIFY COLUMN `batch` int(11) NOT NULL;

-- create field 'email' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `password_resets` ADD COLUMN `email` varchar(255) NOT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field email 
ALTER TABLE `password_resets` MODIFY COLUMN `email` varchar(255) NOT NULL;

-- create field 'token' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `password_resets` ADD COLUMN `token` varchar(255) NOT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field token 
ALTER TABLE `password_resets` MODIFY COLUMN `token` varchar(255) NOT NULL;

-- create field 'created_at' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `password_resets` ADD COLUMN `created_at` timestamp NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field created_at 
ALTER TABLE `password_resets` MODIFY COLUMN `created_at` timestamp NULL;

-- create field 'updated_at' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `password_resets` ADD COLUMN `updated_at` timestamp NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field updated_at 
ALTER TABLE `password_resets` MODIFY COLUMN `updated_at` timestamp NULL;

-- create field 'id' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `settings` ADD COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field id 
ALTER TABLE `settings` MODIFY COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;

-- create field 'name' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `settings` ADD COLUMN `name` varchar(255) NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field name 
ALTER TABLE `settings` MODIFY COLUMN `name` varchar(255) NULL;

-- create field 'value' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `settings` ADD COLUMN `value` text NULL DEFAULT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field value 
ALTER TABLE `settings` MODIFY COLUMN `value` text NULL DEFAULT NULL;

-- create field 'id' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `tevep_invites` ADD COLUMN `id` int(11) NOT NULL AUTO_INCREMENT;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field id 
ALTER TABLE `tevep_invites` MODIFY COLUMN `id` int(11) NOT NULL AUTO_INCREMENT;

-- create field 'tevep_id' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `tevep_invites` ADD COLUMN `tevep_id` int(11) NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field tevep_id 
ALTER TABLE `tevep_invites` MODIFY COLUMN `tevep_id` int(11) NULL;

-- create field 'user_id' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `tevep_invites` ADD COLUMN `user_id` int(11) NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field user_id 
ALTER TABLE `tevep_invites` MODIFY COLUMN `user_id` int(11) NULL;

-- create field 'user_email' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `tevep_invites` ADD COLUMN `user_email` varchar(255) NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field user_email 
ALTER TABLE `tevep_invites` MODIFY COLUMN `user_email` varchar(255) NULL;

-- create field 'status' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `tevep_invites` ADD COLUMN `status` enum('accepted','denied') NULL DEFAULT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field status 
ALTER TABLE `tevep_invites` MODIFY COLUMN `status` enum('accepted','denied') NULL DEFAULT NULL;

-- create field 'created_at' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `tevep_invites` ADD COLUMN `created_at` datetime NULL DEFAULT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field created_at 
ALTER TABLE `tevep_invites` MODIFY COLUMN `created_at` datetime NULL DEFAULT NULL;

-- create field 'updated_at' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `tevep_invites` ADD COLUMN `updated_at` datetime NULL DEFAULT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field updated_at 
ALTER TABLE `tevep_invites` MODIFY COLUMN `updated_at` datetime NULL DEFAULT NULL;

-- create field 'deleted_at' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `tevep_invites` ADD COLUMN `deleted_at` datetime NULL DEFAULT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field deleted_at 
ALTER TABLE `tevep_invites` MODIFY COLUMN `deleted_at` datetime NULL DEFAULT NULL;

-- create field 'id' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `teveps` ADD COLUMN `id` int(10) NOT NULL AUTO_INCREMENT;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field id 
ALTER TABLE `teveps` MODIFY COLUMN `id` int(10) NOT NULL AUTO_INCREMENT;

-- create field 'user_id' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `teveps` ADD COLUMN `user_id` int(11) NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field user_id 
ALTER TABLE `teveps` MODIFY COLUMN `user_id` int(11) NULL;

-- create field 'parent' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `teveps` ADD COLUMN `parent` int(11) NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field parent 
ALTER TABLE `teveps` MODIFY COLUMN `parent` int(11) NULL;

-- create field 'level' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `teveps` ADD COLUMN `level` int(11) NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field level 
ALTER TABLE `teveps` MODIFY COLUMN `level` int(11) NULL;

-- create field 'title' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `teveps` ADD COLUMN `title` varchar(255) NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field title 
ALTER TABLE `teveps` MODIFY COLUMN `title` varchar(255) NULL;

-- create field 'meta' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `teveps` ADD COLUMN `meta` longtext NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field meta 
ALTER TABLE `teveps` MODIFY COLUMN `meta` longtext NULL;

-- create field 'date_start' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `teveps` ADD COLUMN `date_start` text NULL DEFAULT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field date_start 
ALTER TABLE `teveps` MODIFY COLUMN `date_start` text NULL DEFAULT NULL;

-- create field 'date_final' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `teveps` ADD COLUMN `date_final` text NULL DEFAULT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field date_final 
ALTER TABLE `teveps` MODIFY COLUMN `date_final` text NULL DEFAULT NULL;

-- create field 'created_at' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `teveps` ADD COLUMN `created_at` timestamp NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field created_at 
ALTER TABLE `teveps` MODIFY COLUMN `created_at` timestamp NULL;

-- create field 'updated_at' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `teveps` ADD COLUMN `updated_at` timestamp NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field updated_at 
ALTER TABLE `teveps` MODIFY COLUMN `updated_at` timestamp NULL;

-- create field 'deleted_at' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `teveps` ADD COLUMN `deleted_at` timestamp NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field deleted_at 
ALTER TABLE `teveps` MODIFY COLUMN `deleted_at` timestamp NULL;

-- create field 'id' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `user_notifications` ADD COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field id 
ALTER TABLE `user_notifications` MODIFY COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;

-- create field 'created_at' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `user_notifications` ADD COLUMN `created_at` timestamp NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field created_at 
ALTER TABLE `user_notifications` MODIFY COLUMN `created_at` timestamp NULL;

-- create field 'updated_at' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `user_notifications` ADD COLUMN `updated_at` timestamp NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field updated_at 
ALTER TABLE `user_notifications` MODIFY COLUMN `updated_at` timestamp NULL;

-- create field 'user_id' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `user_notifications` ADD COLUMN `user_id` int(11) NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field user_id 
ALTER TABLE `user_notifications` MODIFY COLUMN `user_id` int(11) NULL;

-- create field 'title' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `user_notifications` ADD COLUMN `title` varchar(255) NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field title 
ALTER TABLE `user_notifications` MODIFY COLUMN `title` varchar(255) NULL;

-- create field 'body' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `user_notifications` ADD COLUMN `body` text NULL DEFAULT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field body 
ALTER TABLE `user_notifications` MODIFY COLUMN `body` text NULL DEFAULT NULL;

-- create field 'image' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `user_notifications` ADD COLUMN `image` text NULL DEFAULT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field image 
ALTER TABLE `user_notifications` MODIFY COLUMN `image` text NULL DEFAULT NULL;

-- create field 'seen' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `user_notifications` ADD COLUMN `seen` int(11) NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field seen 
ALTER TABLE `user_notifications` MODIFY COLUMN `seen` int(11) NULL;

-- create field 'url' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `user_notifications` ADD COLUMN `url` text NULL DEFAULT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field url 
ALTER TABLE `user_notifications` MODIFY COLUMN `url` text NULL DEFAULT NULL;

-- create field 'id' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `users` ADD COLUMN `id` int(10) NOT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field id 
ALTER TABLE `users` MODIFY COLUMN `id` int(10) NOT NULL;

-- create field 'name' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `users` ADD COLUMN `name` varchar(255) NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field name 
ALTER TABLE `users` MODIFY COLUMN `name` varchar(255) NULL;

-- create field 'email' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `users` ADD COLUMN `email` varchar(255) NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field email 
ALTER TABLE `users` MODIFY COLUMN `email` varchar(255) NULL;

-- create field 'email_verified_at' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `users` ADD COLUMN `email_verified_at` text NULL DEFAULT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field email_verified_at 
ALTER TABLE `users` MODIFY COLUMN `email_verified_at` text NULL DEFAULT NULL;

-- create field 'password' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `users` ADD COLUMN `password` varchar(255) NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field password 
ALTER TABLE `users` MODIFY COLUMN `password` varchar(255) NULL;

-- create field 'remember_token' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `users` ADD COLUMN `remember_token` varchar(100) NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field remember_token 
ALTER TABLE `users` MODIFY COLUMN `remember_token` varchar(100) NULL;

-- create field 'whatsapp' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `users` ADD COLUMN `whatsapp` varchar(20) NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field whatsapp 
ALTER TABLE `users` MODIFY COLUMN `whatsapp` varchar(20) NULL;

-- create field 'meta' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `users` ADD COLUMN `meta` text NULL DEFAULT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field meta 
ALTER TABLE `users` MODIFY COLUMN `meta` text NULL DEFAULT NULL;

-- create field 'level' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `users` ADD COLUMN `level` enum('admin') NULL DEFAULT NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field level 
ALTER TABLE `users` MODIFY COLUMN `level` enum('admin') NULL DEFAULT NULL;

-- create field 'created_at' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `users` ADD COLUMN `created_at` timestamp NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field created_at 
ALTER TABLE `users` MODIFY COLUMN `created_at` timestamp NULL;

-- create field 'updated_at' if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE `users` ADD COLUMN `updated_at` timestamp NULL;;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- modify field updated_at 
ALTER TABLE `users` MODIFY COLUMN `updated_at` timestamp NULL;

-- creating fk if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE tevep_invites ADD CONSTRAINT FK_tevep_invites_teveps FOREIGN KEY (tevep_id) REFERENCES teveps(id);;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- creating fk if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE tevep_invites ADD CONSTRAINT FK_tevep_invites_users FOREIGN KEY (user_id) REFERENCES users(id);;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- creating fk if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE teveps ADD CONSTRAINT FK_teveps_teveps FOREIGN KEY (parent) REFERENCES teveps(id);;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

-- creating fk if not exists
DROP PROCEDURE IF EXISTS `_temporary`; DELIMITER //
CREATE PROCEDURE `_temporary`() BEGIN
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
	ALTER TABLE teveps ADD CONSTRAINT FK_teveps_users FOREIGN KEY (user_id) REFERENCES users(id);;
END // DELIMITER ; CALL _temporary();
DROP PROCEDURE IF EXISTS `_temporary`;

SET FOREIGN_KEY_CHECKS = 1;