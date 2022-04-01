<?php

/* In case of foreign key error, use commands above:
 * SET FOREIGN_KEY_CHECKS=0;
 * SET GLOBAL FOREIGN_KEY_CHECKS=0;
 */

$database = env('DB_DATABASE');


// Create table emails_templates
\DB::statement("CREATE TABLE IF NOT EXISTS `emails_templates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `models` text COLLATE utf8mb4_unicode_ci,
  `params` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");


// Create/Update column emails_templates.id
\Schema::hasColumn('emails_templates', 'id')?
	\DB::statement("ALTER TABLE emails_templates MODIFY COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT"):
	\DB::statement("ALTER TABLE emails_templates ADD COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");


// Create/Update column emails_templates.slug
\Schema::hasColumn('emails_templates', 'slug')?
	\DB::statement("ALTER TABLE emails_templates MODIFY COLUMN `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL"):
	\DB::statement("ALTER TABLE emails_templates ADD COLUMN `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL");


// Create/Update column emails_templates.name
\Schema::hasColumn('emails_templates', 'name')?
	\DB::statement("ALTER TABLE emails_templates MODIFY COLUMN `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL"):
	\DB::statement("ALTER TABLE emails_templates ADD COLUMN `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL");


// Create/Update column emails_templates.subject
\Schema::hasColumn('emails_templates', 'subject')?
	\DB::statement("ALTER TABLE emails_templates MODIFY COLUMN `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL"):
	\DB::statement("ALTER TABLE emails_templates ADD COLUMN `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL");


// Create/Update column emails_templates.body
\Schema::hasColumn('emails_templates', 'body')?
	\DB::statement("ALTER TABLE emails_templates MODIFY COLUMN `body` text COLLATE utf8mb4_unicode_ci"):
	\DB::statement("ALTER TABLE emails_templates ADD COLUMN `body` text COLLATE utf8mb4_unicode_ci");


// Create/Update column emails_templates.models
\Schema::hasColumn('emails_templates', 'models')?
	\DB::statement("ALTER TABLE emails_templates MODIFY COLUMN `models` text COLLATE utf8mb4_unicode_ci"):
	\DB::statement("ALTER TABLE emails_templates ADD COLUMN `models` text COLLATE utf8mb4_unicode_ci");


// Create/Update column emails_templates.params
\Schema::hasColumn('emails_templates', 'params')?
	\DB::statement("ALTER TABLE emails_templates MODIFY COLUMN `params` text COLLATE utf8mb4_unicode_ci"):
	\DB::statement("ALTER TABLE emails_templates ADD COLUMN `params` text COLLATE utf8mb4_unicode_ci");


// Create/Update column emails_templates.created_at
\Schema::hasColumn('emails_templates', 'created_at')?
	\DB::statement("ALTER TABLE emails_templates MODIFY COLUMN `created_at` datetime DEFAULT NULL"):
	\DB::statement("ALTER TABLE emails_templates ADD COLUMN `created_at` datetime DEFAULT NULL");


// Create/Update column emails_templates.updated_at
\Schema::hasColumn('emails_templates', 'updated_at')?
	\DB::statement("ALTER TABLE emails_templates MODIFY COLUMN `updated_at` datetime DEFAULT NULL"):
	\DB::statement("ALTER TABLE emails_templates ADD COLUMN `updated_at` datetime DEFAULT NULL");


// Create/Update column emails_templates.deleted_at
\Schema::hasColumn('emails_templates', 'deleted_at')?
	\DB::statement("ALTER TABLE emails_templates MODIFY COLUMN `deleted_at` datetime DEFAULT NULL"):
	\DB::statement("ALTER TABLE emails_templates ADD COLUMN `deleted_at` datetime DEFAULT NULL");


// Create table files
\DB::statement("CREATE TABLE IF NOT EXISTS `files` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `folder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `mime` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ext` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_text` int(1) DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");


// Create/Update column files.id
\Schema::hasColumn('files', 'id')?
	\DB::statement("ALTER TABLE files MODIFY COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT"):
	\DB::statement("ALTER TABLE files ADD COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");


// Create/Update column files.slug
\Schema::hasColumn('files', 'slug')?
	\DB::statement("ALTER TABLE files MODIFY COLUMN `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL"):
	\DB::statement("ALTER TABLE files ADD COLUMN `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL");


// Create/Update column files.name
\Schema::hasColumn('files', 'name')?
	\DB::statement("ALTER TABLE files MODIFY COLUMN `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL"):
	\DB::statement("ALTER TABLE files ADD COLUMN `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL");


// Create/Update column files.folder
\Schema::hasColumn('files', 'folder')?
	\DB::statement("ALTER TABLE files MODIFY COLUMN `folder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL"):
	\DB::statement("ALTER TABLE files ADD COLUMN `folder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL");


// Create/Update column files.size
\Schema::hasColumn('files', 'size')?
	\DB::statement("ALTER TABLE files MODIFY COLUMN `size` int(11) DEFAULT NULL"):
	\DB::statement("ALTER TABLE files ADD COLUMN `size` int(11) DEFAULT NULL");


// Create/Update column files.mime
\Schema::hasColumn('files', 'mime')?
	\DB::statement("ALTER TABLE files MODIFY COLUMN `mime` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL"):
	\DB::statement("ALTER TABLE files ADD COLUMN `mime` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL");


// Create/Update column files.type
\Schema::hasColumn('files', 'type')?
	\DB::statement("ALTER TABLE files MODIFY COLUMN `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL"):
	\DB::statement("ALTER TABLE files ADD COLUMN `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL");


// Create/Update column files.ext
\Schema::hasColumn('files', 'ext')?
	\DB::statement("ALTER TABLE files MODIFY COLUMN `ext` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL"):
	\DB::statement("ALTER TABLE files ADD COLUMN `ext` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL");


// Create/Update column files.is_text
\Schema::hasColumn('files', 'is_text')?
	\DB::statement("ALTER TABLE files MODIFY COLUMN `is_text` int(1) DEFAULT NULL"):
	\DB::statement("ALTER TABLE files ADD COLUMN `is_text` int(1) DEFAULT NULL");


// Create/Update column files.url
\Schema::hasColumn('files', 'url')?
	\DB::statement("ALTER TABLE files MODIFY COLUMN `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL"):
	\DB::statement("ALTER TABLE files ADD COLUMN `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL");


// Create/Update column files.content
\Schema::hasColumn('files', 'content')?
	\DB::statement("ALTER TABLE files MODIFY COLUMN `content` longtext COLLATE utf8mb4_unicode_ci"):
	\DB::statement("ALTER TABLE files ADD COLUMN `content` longtext COLLATE utf8mb4_unicode_ci");


// Create/Update column files.created_at
\Schema::hasColumn('files', 'created_at')?
	\DB::statement("ALTER TABLE files MODIFY COLUMN `created_at` timestamp NULL DEFAULT NULL"):
	\DB::statement("ALTER TABLE files ADD COLUMN `created_at` timestamp NULL DEFAULT NULL");


// Create/Update column files.updated_at
\Schema::hasColumn('files', 'updated_at')?
	\DB::statement("ALTER TABLE files MODIFY COLUMN `updated_at` timestamp NULL DEFAULT NULL"):
	\DB::statement("ALTER TABLE files ADD COLUMN `updated_at` timestamp NULL DEFAULT NULL");


// Create/Update column files.deleted_at
\Schema::hasColumn('files', 'deleted_at')?
	\DB::statement("ALTER TABLE files MODIFY COLUMN `deleted_at` datetime DEFAULT NULL"):
	\DB::statement("ALTER TABLE files ADD COLUMN `deleted_at` datetime DEFAULT NULL");


// Create table pages
\DB::statement("CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pages_owner_id_foreign` (`owner_id`),
  CONSTRAINT `pages_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");


// Create/Update column pages.id
\Schema::hasColumn('pages', 'id')?
	\DB::statement("ALTER TABLE pages MODIFY COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT"):
	\DB::statement("ALTER TABLE pages ADD COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");


// Create/Update column pages.slug
\Schema::hasColumn('pages', 'slug')?
	\DB::statement("ALTER TABLE pages MODIFY COLUMN `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL"):
	\DB::statement("ALTER TABLE pages ADD COLUMN `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL");


// Create/Update column pages.name
\Schema::hasColumn('pages', 'name')?
	\DB::statement("ALTER TABLE pages MODIFY COLUMN `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL"):
	\DB::statement("ALTER TABLE pages ADD COLUMN `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL");


// Create/Update column pages.content
\Schema::hasColumn('pages', 'content')?
	\DB::statement("ALTER TABLE pages MODIFY COLUMN `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL"):
	\DB::statement("ALTER TABLE pages ADD COLUMN `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL");


// Create/Update column pages.owner_id
\Schema::hasColumn('pages', 'owner_id')?
	\DB::statement("ALTER TABLE pages MODIFY COLUMN `owner_id` bigint(20) unsigned DEFAULT NULL"):
	\DB::statement("ALTER TABLE pages ADD COLUMN `owner_id` bigint(20) unsigned DEFAULT NULL");


// Create/Update column pages.created_at
\Schema::hasColumn('pages', 'created_at')?
	\DB::statement("ALTER TABLE pages MODIFY COLUMN `created_at` timestamp NULL DEFAULT NULL"):
	\DB::statement("ALTER TABLE pages ADD COLUMN `created_at` timestamp NULL DEFAULT NULL");


// Create/Update column pages.updated_at
\Schema::hasColumn('pages', 'updated_at')?
	\DB::statement("ALTER TABLE pages MODIFY COLUMN `updated_at` timestamp NULL DEFAULT NULL"):
	\DB::statement("ALTER TABLE pages ADD COLUMN `updated_at` timestamp NULL DEFAULT NULL");


// Create/Update column pages.deleted_at
\Schema::hasColumn('pages', 'deleted_at')?
	\DB::statement("ALTER TABLE pages MODIFY COLUMN `deleted_at` datetime DEFAULT NULL"):
	\DB::statement("ALTER TABLE pages ADD COLUMN `deleted_at` datetime DEFAULT NULL");


// Create fk pages_owner_id_foreign
if (! collect(\DB::select("SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE CONSTRAINT_SCHEMA='{$database}' AND CONSTRAINT_NAME='pages_owner_id_foreign'"))->first()) {
	\DB::select("ALTER TABLE `pages` ADD CONSTRAINT `pages_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL");
}


// Create table settings
\DB::statement("CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");


// Create/Update column settings.id
\Schema::hasColumn('settings', 'id')?
	\DB::statement("ALTER TABLE settings MODIFY COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT"):
	\DB::statement("ALTER TABLE settings ADD COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");


// Create/Update column settings.name
\Schema::hasColumn('settings', 'name')?
	\DB::statement("ALTER TABLE settings MODIFY COLUMN `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL"):
	\DB::statement("ALTER TABLE settings ADD COLUMN `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL");


// Create/Update column settings.value
\Schema::hasColumn('settings', 'value')?
	\DB::statement("ALTER TABLE settings MODIFY COLUMN `value` text COLLATE utf8mb4_unicode_ci NOT NULL"):
	\DB::statement("ALTER TABLE settings ADD COLUMN `value` text COLLATE utf8mb4_unicode_ci NOT NULL");


// Create/Update column settings.created_at
\Schema::hasColumn('settings', 'created_at')?
	\DB::statement("ALTER TABLE settings MODIFY COLUMN `created_at` timestamp NULL DEFAULT NULL"):
	\DB::statement("ALTER TABLE settings ADD COLUMN `created_at` timestamp NULL DEFAULT NULL");


// Create/Update column settings.updated_at
\Schema::hasColumn('settings', 'updated_at')?
	\DB::statement("ALTER TABLE settings MODIFY COLUMN `updated_at` timestamp NULL DEFAULT NULL"):
	\DB::statement("ALTER TABLE settings ADD COLUMN `updated_at` timestamp NULL DEFAULT NULL");


// Create table teveps
\DB::statement("CREATE TABLE IF NOT EXISTS `teveps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_id` bigint(20) unsigned DEFAULT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `meta_ref` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta` text COLLATE utf8mb4_unicode_ci COMMENT 'Json data',
  `date_start` datetime DEFAULT NULL,
  `date_final` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");


// Create/Update column teveps.id
\Schema::hasColumn('teveps', 'id')?
	\DB::statement("ALTER TABLE teveps MODIFY COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT"):
	\DB::statement("ALTER TABLE teveps ADD COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");


// Create/Update column teveps.slug
\Schema::hasColumn('teveps', 'slug')?
	\DB::statement("ALTER TABLE teveps MODIFY COLUMN `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL"):
	\DB::statement("ALTER TABLE teveps ADD COLUMN `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL");


// Create/Update column teveps.name
\Schema::hasColumn('teveps', 'name')?
	\DB::statement("ALTER TABLE teveps MODIFY COLUMN `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL"):
	\DB::statement("ALTER TABLE teveps ADD COLUMN `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL");


// Create/Update column teveps.owner_id
\Schema::hasColumn('teveps', 'owner_id')?
	\DB::statement("ALTER TABLE teveps MODIFY COLUMN `owner_id` bigint(20) unsigned DEFAULT NULL"):
	\DB::statement("ALTER TABLE teveps ADD COLUMN `owner_id` bigint(20) unsigned DEFAULT NULL");


// Create/Update column teveps.parent_id
\Schema::hasColumn('teveps', 'parent_id')?
	\DB::statement("ALTER TABLE teveps MODIFY COLUMN `parent_id` bigint(20) unsigned DEFAULT NULL"):
	\DB::statement("ALTER TABLE teveps ADD COLUMN `parent_id` bigint(20) unsigned DEFAULT NULL");


// Create/Update column teveps.meta_ref
\Schema::hasColumn('teveps', 'meta_ref')?
	\DB::statement("ALTER TABLE teveps MODIFY COLUMN `meta_ref` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL"):
	\DB::statement("ALTER TABLE teveps ADD COLUMN `meta_ref` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL");


// Create/Update column teveps.meta
\Schema::hasColumn('teveps', 'meta')?
	\DB::statement("ALTER TABLE teveps MODIFY COLUMN `meta` text COLLATE utf8mb4_unicode_ci COMMENT 'Json data'"):
	\DB::statement("ALTER TABLE teveps ADD COLUMN `meta` text COLLATE utf8mb4_unicode_ci COMMENT 'Json data'");


// Create/Update column teveps.date_start
\Schema::hasColumn('teveps', 'date_start')?
	\DB::statement("ALTER TABLE teveps MODIFY COLUMN `date_start` datetime DEFAULT NULL"):
	\DB::statement("ALTER TABLE teveps ADD COLUMN `date_start` datetime DEFAULT NULL");


// Create/Update column teveps.date_final
\Schema::hasColumn('teveps', 'date_final')?
	\DB::statement("ALTER TABLE teveps MODIFY COLUMN `date_final` datetime DEFAULT NULL"):
	\DB::statement("ALTER TABLE teveps ADD COLUMN `date_final` datetime DEFAULT NULL");


// Create/Update column teveps.created_at
\Schema::hasColumn('teveps', 'created_at')?
	\DB::statement("ALTER TABLE teveps MODIFY COLUMN `created_at` datetime DEFAULT NULL"):
	\DB::statement("ALTER TABLE teveps ADD COLUMN `created_at` datetime DEFAULT NULL");


// Create/Update column teveps.updated_at
\Schema::hasColumn('teveps', 'updated_at')?
	\DB::statement("ALTER TABLE teveps MODIFY COLUMN `updated_at` datetime DEFAULT NULL"):
	\DB::statement("ALTER TABLE teveps ADD COLUMN `updated_at` datetime DEFAULT NULL");


// Create/Update column teveps.deleted_at
\Schema::hasColumn('teveps', 'deleted_at')?
	\DB::statement("ALTER TABLE teveps MODIFY COLUMN `deleted_at` datetime DEFAULT NULL"):
	\DB::statement("ALTER TABLE teveps ADD COLUMN `deleted_at` datetime DEFAULT NULL");


// Create table teveps_invites
\DB::statement("CREATE TABLE IF NOT EXISTS `teveps_invites` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('accepted','denied') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tevep_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_teveps_invites_teveps` (`tevep_id`),
  CONSTRAINT `FK_teveps_invites_teveps` FOREIGN KEY (`tevep_id`) REFERENCES `teveps` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");


// Create/Update column teveps_invites.id
\Schema::hasColumn('teveps_invites', 'id')?
	\DB::statement("ALTER TABLE teveps_invites MODIFY COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT"):
	\DB::statement("ALTER TABLE teveps_invites ADD COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");


// Create/Update column teveps_invites.slug
\Schema::hasColumn('teveps_invites', 'slug')?
	\DB::statement("ALTER TABLE teveps_invites MODIFY COLUMN `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL"):
	\DB::statement("ALTER TABLE teveps_invites ADD COLUMN `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL");


// Create/Update column teveps_invites.name
\Schema::hasColumn('teveps_invites', 'name')?
	\DB::statement("ALTER TABLE teveps_invites MODIFY COLUMN `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL"):
	\DB::statement("ALTER TABLE teveps_invites ADD COLUMN `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL");


// Create/Update column teveps_invites.user_id
\Schema::hasColumn('teveps_invites', 'user_id')?
	\DB::statement("ALTER TABLE teveps_invites MODIFY COLUMN `user_id` bigint(20) unsigned DEFAULT NULL"):
	\DB::statement("ALTER TABLE teveps_invites ADD COLUMN `user_id` bigint(20) unsigned DEFAULT NULL");


// Create/Update column teveps_invites.user_email
\Schema::hasColumn('teveps_invites', 'user_email')?
	\DB::statement("ALTER TABLE teveps_invites MODIFY COLUMN `user_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL"):
	\DB::statement("ALTER TABLE teveps_invites ADD COLUMN `user_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL");


// Create/Update column teveps_invites.status
\Schema::hasColumn('teveps_invites', 'status')?
	\DB::statement("ALTER TABLE teveps_invites MODIFY COLUMN `status` enum('accepted','denied') COLLATE utf8mb4_unicode_ci DEFAULT NULL"):
	\DB::statement("ALTER TABLE teveps_invites ADD COLUMN `status` enum('accepted','denied') COLLATE utf8mb4_unicode_ci DEFAULT NULL");


// Create/Update column teveps_invites.tevep_id
\Schema::hasColumn('teveps_invites', 'tevep_id')?
	\DB::statement("ALTER TABLE teveps_invites MODIFY COLUMN `tevep_id` bigint(20) unsigned DEFAULT NULL"):
	\DB::statement("ALTER TABLE teveps_invites ADD COLUMN `tevep_id` bigint(20) unsigned DEFAULT NULL");


// Create/Update column teveps_invites.created_at
\Schema::hasColumn('teveps_invites', 'created_at')?
	\DB::statement("ALTER TABLE teveps_invites MODIFY COLUMN `created_at` datetime DEFAULT NULL"):
	\DB::statement("ALTER TABLE teveps_invites ADD COLUMN `created_at` datetime DEFAULT NULL");


// Create/Update column teveps_invites.updated_at
\Schema::hasColumn('teveps_invites', 'updated_at')?
	\DB::statement("ALTER TABLE teveps_invites MODIFY COLUMN `updated_at` datetime DEFAULT NULL"):
	\DB::statement("ALTER TABLE teveps_invites ADD COLUMN `updated_at` datetime DEFAULT NULL");


// Create/Update column teveps_invites.deleted_at
\Schema::hasColumn('teveps_invites', 'deleted_at')?
	\DB::statement("ALTER TABLE teveps_invites MODIFY COLUMN `deleted_at` datetime DEFAULT NULL"):
	\DB::statement("ALTER TABLE teveps_invites ADD COLUMN `deleted_at` datetime DEFAULT NULL");


// Create fk FK_teveps_invites_teveps
if (! collect(\DB::select("SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE CONSTRAINT_SCHEMA='{$database}' AND CONSTRAINT_NAME='FK_teveps_invites_teveps'"))->first()) {
	\DB::select("ALTER TABLE `teveps_invites` ADD CONSTRAINT `FK_teveps_invites_teveps` FOREIGN KEY (`tevep_id`) REFERENCES `teveps` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION");
}


// Create table users
\DB::statement("CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_id` bigint(20) unsigned DEFAULT NULL,
  `group_id` bigint(20) unsigned DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_photo_id_foreign` (`photo_id`),
  KEY `FK_users_users_groups` (`group_id`),
  CONSTRAINT `FK_users_users_groups` FOREIGN KEY (`group_id`) REFERENCES `users_groups` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `users_photo_id_foreign` FOREIGN KEY (`photo_id`) REFERENCES `files` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");


// Create/Update column users.id
\Schema::hasColumn('users', 'id')?
	\DB::statement("ALTER TABLE users MODIFY COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT"):
	\DB::statement("ALTER TABLE users ADD COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");


// Create/Update column users.name
\Schema::hasColumn('users', 'name')?
	\DB::statement("ALTER TABLE users MODIFY COLUMN `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL"):
	\DB::statement("ALTER TABLE users ADD COLUMN `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL");


// Create/Update column users.email
\Schema::hasColumn('users', 'email')?
	\DB::statement("ALTER TABLE users MODIFY COLUMN `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL"):
	\DB::statement("ALTER TABLE users ADD COLUMN `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL");


// Create/Update column users.photo_id
\Schema::hasColumn('users', 'photo_id')?
	\DB::statement("ALTER TABLE users MODIFY COLUMN `photo_id` bigint(20) unsigned DEFAULT NULL"):
	\DB::statement("ALTER TABLE users ADD COLUMN `photo_id` bigint(20) unsigned DEFAULT NULL");


// Create/Update column users.group_id
\Schema::hasColumn('users', 'group_id')?
	\DB::statement("ALTER TABLE users MODIFY COLUMN `group_id` bigint(20) unsigned DEFAULT NULL"):
	\DB::statement("ALTER TABLE users ADD COLUMN `group_id` bigint(20) unsigned DEFAULT NULL");


// Create/Update column users.email_verified_at
\Schema::hasColumn('users', 'email_verified_at')?
	\DB::statement("ALTER TABLE users MODIFY COLUMN `email_verified_at` timestamp NULL DEFAULT NULL"):
	\DB::statement("ALTER TABLE users ADD COLUMN `email_verified_at` timestamp NULL DEFAULT NULL");


// Create/Update column users.password
\Schema::hasColumn('users', 'password')?
	\DB::statement("ALTER TABLE users MODIFY COLUMN `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL"):
	\DB::statement("ALTER TABLE users ADD COLUMN `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL");


// Create/Update column users.remember_token
\Schema::hasColumn('users', 'remember_token')?
	\DB::statement("ALTER TABLE users MODIFY COLUMN `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL"):
	\DB::statement("ALTER TABLE users ADD COLUMN `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL");


// Create/Update column users.created_at
\Schema::hasColumn('users', 'created_at')?
	\DB::statement("ALTER TABLE users MODIFY COLUMN `created_at` timestamp NULL DEFAULT NULL"):
	\DB::statement("ALTER TABLE users ADD COLUMN `created_at` timestamp NULL DEFAULT NULL");


// Create/Update column users.updated_at
\Schema::hasColumn('users', 'updated_at')?
	\DB::statement("ALTER TABLE users MODIFY COLUMN `updated_at` timestamp NULL DEFAULT NULL"):
	\DB::statement("ALTER TABLE users ADD COLUMN `updated_at` timestamp NULL DEFAULT NULL");


// Create fk FK_users_users_groups
if (! collect(\DB::select("SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE CONSTRAINT_SCHEMA='{$database}' AND CONSTRAINT_NAME='FK_users_users_groups'"))->first()) {
	\DB::select("ALTER TABLE `users` ADD CONSTRAINT `FK_users_users_groups` FOREIGN KEY (`group_id`) REFERENCES `users_groups` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,");
}


// Create fk users_photo_id_foreign
if (! collect(\DB::select("SELECT * FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE CONSTRAINT_SCHEMA='{$database}' AND CONSTRAINT_NAME='users_photo_id_foreign'"))->first()) {
	\DB::select("ALTER TABLE `users` ADD CONSTRAINT `users_photo_id_foreign` FOREIGN KEY (`photo_id`) REFERENCES `files` (`id`) ON DELETE SET NULL ON UPDATE SET NULL");
}


// Create table users_groups
\DB::statement("CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissions` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");


// Create/Update column users_groups.id
\Schema::hasColumn('users_groups', 'id')?
	\DB::statement("ALTER TABLE users_groups MODIFY COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT"):
	\DB::statement("ALTER TABLE users_groups ADD COLUMN `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT");


// Create/Update column users_groups.slug
\Schema::hasColumn('users_groups', 'slug')?
	\DB::statement("ALTER TABLE users_groups MODIFY COLUMN `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL"):
	\DB::statement("ALTER TABLE users_groups ADD COLUMN `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL");


// Create/Update column users_groups.name
\Schema::hasColumn('users_groups', 'name')?
	\DB::statement("ALTER TABLE users_groups MODIFY COLUMN `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL"):
	\DB::statement("ALTER TABLE users_groups ADD COLUMN `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL");


// Create/Update column users_groups.permissions
\Schema::hasColumn('users_groups', 'permissions')?
	\DB::statement("ALTER TABLE users_groups MODIFY COLUMN `permissions` longtext COLLATE utf8mb4_unicode_ci"):
	\DB::statement("ALTER TABLE users_groups ADD COLUMN `permissions` longtext COLLATE utf8mb4_unicode_ci");


// Create/Update column users_groups.created_at
\Schema::hasColumn('users_groups', 'created_at')?
	\DB::statement("ALTER TABLE users_groups MODIFY COLUMN `created_at` datetime DEFAULT NULL"):
	\DB::statement("ALTER TABLE users_groups ADD COLUMN `created_at` datetime DEFAULT NULL");


// Create/Update column users_groups.updated_at
\Schema::hasColumn('users_groups', 'updated_at')?
	\DB::statement("ALTER TABLE users_groups MODIFY COLUMN `updated_at` datetime DEFAULT NULL"):
	\DB::statement("ALTER TABLE users_groups ADD COLUMN `updated_at` datetime DEFAULT NULL");


// Create/Update column users_groups.deleted_at
\Schema::hasColumn('users_groups', 'deleted_at')?
	\DB::statement("ALTER TABLE users_groups MODIFY COLUMN `deleted_at` datetime DEFAULT NULL"):
	\DB::statement("ALTER TABLE users_groups ADD COLUMN `deleted_at` datetime DEFAULT NULL");