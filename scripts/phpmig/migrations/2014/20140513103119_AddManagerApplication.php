<?php
use MyPhpmig\Police\Migration;

class AddManagerApplication extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        // We only need to run this migration once, but since the database has to be created first,
        // we use a random zone number to limit the number of times these queries will be run.
        $zones = $this->getZones()->get();
        $key   = key($zones);

        $this->getZones()->set(array($key => $zones[$key]));

        $this->_queries = <<<EOL
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
SET @OLD_TIME_ZONE=@@TIME_ZONE, TIME_ZONE='+00:00';
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;

DROP DATABASE IF EXISTS `manager`;
CREATE DATABASE `manager` CHARACTER SET utf8;

DROP TABLE IF EXISTS `manager`.`extensions`;
CREATE TABLE `manager`.`extensions` (
  `extensions_extension_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`extensions_extension_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `manager`.`languages`;
CREATE TABLE `manager`.`languages` (
  `languages_language_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application` varchar(50) NOT NULL,
  `name` varchar(150) NOT NULL,
  `native_name` varchar(150) NOT NULL,
  `iso_code` varchar(8) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  `primary` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`languages_language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `manager`.`languages` (`languages_language_id`, `application`, `name`, `native_name`, `iso_code`, `slug`, `enabled`, `primary`)
VALUES
	(1, 'admin', 'English (United Kingdom)', 'English (United Kingdom)', 'en-GB', 'en', 1, 1),
	(2, 'site', 'English (United Kingdom)', 'English (United Kingdom)', 'en-GB', 'en', 1, 1);

DROP TABLE IF EXISTS `manager`.`languages_tables`;
CREATE TABLE `manager`.`languages_tables` (
  `languages_table_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `extensions_extension_id` int(11) unsigned DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `unique_column` varchar(64) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`languages_table_id`),
  KEY `languages_tables__extensions_extension_id` (`extensions_extension_id`),
  CONSTRAINT `languages_tables__extensions_extension_id` FOREIGN KEY (`extensions_extension_id`) REFERENCES `manager`.`extensions` (`extensions_extension_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `manager`.`languages_translations`;
CREATE TABLE `manager`.`languages_translations` (
  `languages_translation_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `iso_code` varchar(8) NOT NULL,
  `table` varchar(64) NOT NULL,
  `row` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `original` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`languages_translation_id`),
  KEY `table_row_iso_code` (`table`,`row`,`iso_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `manager`.`pages`;
CREATE TABLE `manager`.`pages` (
  `pages_page_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pages_menu_id` int(10) unsigned NOT NULL,
  `users_group_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `link_url` text,
  `link_id` int(11) unsigned DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `hidden` tinyint(1) NOT NULL DEFAULT '0',
  `home` tinyint(1) NOT NULL DEFAULT '0',
  `extensions_extension_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(10) unsigned DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `params` text,
  PRIMARY KEY (`pages_page_id`),
  KEY `pages__pages_menu_id` (`pages_menu_id`),
  KEY `pages__link_id` (`link_id`),
  KEY `ix_published` (`published`),
  KEY `ix_home` (`home`),
  KEY `ix_extensions_extension_id` (`extensions_extension_id`),
  CONSTRAINT `pages__link_id` FOREIGN KEY (`link_id`) REFERENCES `manager`.`pages` (`pages_page_id`) ON DELETE CASCADE,
  CONSTRAINT `pages__pages_menu_id` FOREIGN KEY (`pages_menu_id`) REFERENCES `manager`.`pages_menus` (`pages_menu_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `manager`.`pages_closures`;
CREATE TABLE `manager`.`pages_closures` (
  `ancestor_id` int(11) unsigned NOT NULL,
  `descendant_id` int(11) unsigned NOT NULL,
  `level` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ancestor_id`,`descendant_id`),
  KEY `ix_level` (`level`),
  KEY `ix_descendant_id` (`descendant_id`),
  CONSTRAINT `pages_closures__ancestor_id` FOREIGN KEY (`ancestor_id`) REFERENCES `manager`.`pages` (`pages_page_id`) ON DELETE CASCADE,
  CONSTRAINT `pages_closures__descendant_id` FOREIGN KEY (`descendant_id`) REFERENCES `manager`.`pages` (`pages_page_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `manager`.`pages_menus`;
CREATE TABLE `manager`.`pages_menus` (
  `pages_menu_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `application` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(10) unsigned DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  PRIMARY KEY (`pages_menu_id`),
  KEY `ix_application` (`application`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `manager`.`pages_modules`;
CREATE TABLE `manager`.`pages_modules` (
  `pages_module_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `position` varchar(50) DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(10) unsigned DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `extensions_extension_id` int(11) unsigned NOT NULL,
  `application` varchar(50) NOT NULL,
  PRIMARY KEY (`pages_module_id`),
  KEY `published` (`published`,`access`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `manager`.`pages_modules_pages`;
CREATE TABLE `manager`.`pages_modules_pages` (
  `pages_module_id` int(11) unsigned NOT NULL,
  `pages_page_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`pages_module_id`,`pages_page_id`),
  KEY `pages_modules_pages__pages_page_id` (`pages_page_id`),
  CONSTRAINT `pages_modules_pages__pages_module_id` FOREIGN KEY (`pages_module_id`) REFERENCES `manager`.`pages_modules` (`pages_module_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pages_modules_pages__pages_page_id` FOREIGN KEY (`pages_page_id`) REFERENCES `manager`.`pages` (`pages_page_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `manager`.`pages_orderings`;
CREATE TABLE `manager`.`pages_orderings` (
  `pages_page_id` int(11) unsigned NOT NULL,
  `title` int(11) unsigned zerofill NOT NULL DEFAULT '00000000000',
  `custom` int(11) unsigned zerofill NOT NULL DEFAULT '00000000000',
  PRIMARY KEY (`pages_page_id`),
  KEY `ix_title` (`title`),
  KEY `ix_custom` (`custom`),
  CONSTRAINT `pages_orderings__pages_page_id` FOREIGN KEY (`pages_page_id`) REFERENCES `manager`.`pages` (`pages_page_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `manager`.`users`;
CREATE TABLE `manager`.`users` (
  `users_user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `send_email` tinyint(1) DEFAULT '0',
  `users_role_id` int(11) unsigned NOT NULL DEFAULT '18',
  `last_visited_on` datetime DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(10) unsigned DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  `activation` varchar(100) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `uuid` char(36) NOT NULL,
  PRIMARY KEY (`users_user_id`),
  UNIQUE KEY `uuid` (`uuid`),
  UNIQUE KEY `email` (`email`),
  KEY `users_role_id` (`users_role_id`),
  CONSTRAINT `users_user_role` FOREIGN KEY (`users_role_id`) REFERENCES `manager`.`users_roles` (`users_role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `manager`.`users_groups`;
CREATE TABLE `manager`.`users_groups` (
  `users_group_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`users_group_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `manager`.`users_groups_users`;
CREATE TABLE `manager`.`users_groups_users` (
  `users_group_id` int(11) unsigned NOT NULL,
  `users_user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`users_group_id`,`users_user_id`),
  KEY `users_groups_users__users_user_id` (`users_user_id`),
  CONSTRAINT `users_groups_users__users_group_id` FOREIGN KEY (`users_group_id`) REFERENCES `manager`.`users_groups` (`users_group_id`) ON DELETE CASCADE,
  CONSTRAINT `users_groups_users__users_user_id` FOREIGN KEY (`users_user_id`) REFERENCES `manager`.`users` (`users_user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `manager`.`users_passwords`;
CREATE TABLE `manager`.`users_passwords` (
  `email` varchar(100) NOT NULL DEFAULT '',
  `expiration` date DEFAULT NULL,
  `hash` varchar(100) NOT NULL DEFAULT '',
  `reset` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`email`),
  CONSTRAINT `users_password__email` FOREIGN KEY (`email`) REFERENCES `manager`.`users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `manager`.`users_roles`;
CREATE TABLE `manager`.`users_roles` (
  `users_role_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`users_role_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `manager`.`users_sessions`;
CREATE TABLE `manager`.`users_sessions` (
  `time` varchar(14) DEFAULT '',
  `users_session_id` varchar(128) NOT NULL,
  `guest` tinyint(4) DEFAULT '1',
  `email` varchar(100) NOT NULL COMMENT '@Filter("email")',
  `application` varchar(50) NOT NULL,
  `data` longtext,
  PRIMARY KEY (`users_session_id`(64)),
  KEY `whosonline` (`guest`),
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `manager`.`extensions` (`extensions_extension_id`, `title`, `name`, `params`, `enabled`)
VALUES
  (1, 'Dashboard', 'com_dashboard', '', 1),
  (2, 'Support', 'com_support', '', 1),
  (3, 'Users', 'com_users', '', 1);

INSERT INTO `manager`.`pages_menus` (`pages_menu_id`, `application`, `title`, `slug`, `description`, `created_by`) VALUES (1, 'manager', 'Menubar', 'menubar', 'Manager site main menu', '1');


INSERT INTO `manager`.`pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`)
VALUES
  (1, 1, 0, 'Dashboard', 'dashboard', 'option=com_dashboard&view=dashboard', 'component', 1, 0, 0, 1, 1),
  (2, 1, 0, 'Support', 'support', 'option=com_support&view=tickets', 'component', 1, 0, 0, 2, 1);


INSERT INTO `manager`.`pages_orderings` (`pages_page_id`, `title`, `custom`)
VALUES
  (1, 00000000001, 00000000001),
  (2, 00000000002, 00000000002);


INSERT INTO `manager`.`pages_closures` (`ancestor_id`, `descendant_id`, `level`)
VALUES
  (1, 1, 0),
  (2, 2, 0);


INSERT INTO `manager`.`users` (`users_user_id`, `name`, `email`, `enabled`, `send_email`, `users_role_id`, `last_visited_on`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `activation`, `params`, `uuid`)
VALUES
  (1,'Administrator','admin@localhost.home',1,1,25,'2013-11-05 14:23:08',NULL,NULL,1,'2013-11-05 14:23:08',NULL,NULL,'','timezone=\n\n','3b8abc10-b038-11e2-9296-102175e93138');


INSERT INTO `manager`.`users_groups` (`users_group_id`, `name`, `description`)
VALUES
  (1,'Webmasters',''),
  (2,'Super Administrators','');


INSERT INTO `manager`.`users_groups_users` (`users_group_id`, `users_user_id`)
VALUES
  (2,1);


INSERT INTO `manager`.`users_passwords` (`email`, `expiration`, `hash`, `reset`)
VALUES
  ('admin@localhost.home',NULL,'$2y$10\$UT7uLipGnbJbTcjZ6D.OAeVByFn.2ZpPmd.thZ5e5xHLwKXAxdvNG','');


INSERT INTO `manager`.`users_roles` (`users_role_id`, `name`, `description`)
VALUES
  (25,'Super Administrator','');

SET SQL_MODE=@OLD_SQL_MODE;
SET TIME_ZONE=@OLD_TIME_ZONE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
EOL;

        parent::up();

    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->getZones()->set(array('manager' => 'manager'));

        $this->_queries = <<<EOL
DROP DATABASE IF EXISTS `manager`;
EOL;

        parent::down();
    }
}
