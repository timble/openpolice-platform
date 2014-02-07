SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
SET @OLD_TIME_ZONE=@@TIME_ZONE, TIME_ZONE='+00:00';
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;


--
-- Table structure data for table `about`
--

DROP TABLE IF EXISTS `about`;

CREATE TABLE `about` (
  `about_article_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attachments_attachment_id` int(11) unsigned NOT NULL DEFAULT '0',
  `categories_category_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(11) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(11) unsigned DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  `publish_on` datetime DEFAULT NULL,
  `unpublish_on` datetime DEFAULT NULL,
  `params` text,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `description` text,
  `access` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`about_article_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `idx_access` (`access`),
  KEY `idx_state` (`published`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_catid` (`categories_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `activities`
--

DROP TABLE IF EXISTS `activities`;

CREATE TABLE `activities` (
  `activities_activity_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) NOT NULL DEFAULT '',
  `application` varchar(10) NOT NULL DEFAULT '',
  `package` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `action` varchar(50) NOT NULL DEFAULT '',
  `row` varchar(2048) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(45) NOT NULL DEFAULT '',
  `metadata` text NOT NULL,
  PRIMARY KEY (`activities_activity_id`),
  UNIQUE KEY `uuid` (`uuid`),
  KEY `package` (`package`),
  KEY `name` (`name`),
  KEY `row` (`row`(255)),
  KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `articles`
--

DROP TABLE IF EXISTS `articles`;

CREATE TABLE `articles` (
  `articles_article_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attachments_attachment_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `categories_category_id` int(11) unsigned NOT NULL DEFAULT '0',
  `created_by` int(11) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(11) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(11) unsigned DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  `publish_on` datetime DEFAULT NULL,
  `unpublish_on` datetime DEFAULT NULL,
  `params` text,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `description` text,
  `access` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`articles_article_id`),
  KEY `idx_access` (`access`),
  KEY `idx_state` (`published`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_catid` (`categories_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;

CREATE TABLE `attachments` (
  `attachments_attachment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `container` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `description` text,
  `created_by` int(11) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(11) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(11) unsigned DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  PRIMARY KEY (`attachments_attachment_id`),
  KEY `path` (`path`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `attachments_relations`
--

DROP TABLE IF EXISTS `attachments_relations`;

CREATE TABLE `attachments_relations` (
  `attachments_attachment_id` int(10) unsigned NOT NULL,
  `table` varchar(64) NOT NULL,
  `row` int(10) unsigned NOT NULL,
  KEY `attachments_attachment_id` (`attachments_attachment_id`),
  CONSTRAINT `attachments_relations_ibfk_1` FOREIGN KEY (`attachments_attachment_id`) REFERENCES `attachments` (`attachments_attachment_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `categories`
--

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `categories_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `attachments_attachment_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `table` varchar(50) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(10) unsigned DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`categories_category_id`),
  UNIQUE KEY `slug` (`slug`,`table`),
  KEY `cat_idx` (`table`,`published`,`access`),
  KEY `idx_access` (`access`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `comments`
--

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `comments_comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table` varchar(64) NOT NULL,
  `row` int(10) unsigned NOT NULL,
  `text` text,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  `locked_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`comments_comment_id`),
  KEY `idx_table_row` (`table`,`row`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts` (
  `contacts_contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `categories_category_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `slug` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `address` text,
  `suburb` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `misc` mediumtext,
  `email_to` varchar(255) DEFAULT NULL,
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created_by` int(11) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(11) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(11) unsigned DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`contacts_contact_id`),
  KEY `category` (`categories_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `districts`
--

DROP TABLE IF EXISTS `districts`;

CREATE TABLE `districts` (
  `districts_district_id` varchar(250) NOT NULL DEFAULT '',
  `contacts_contact_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`districts_district_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `districts_districts_officers`
--

DROP TABLE IF EXISTS `districts_districts_officers`;

CREATE TABLE `districts_districts_officers` (
  `districts_district_id` varchar(250) NOT NULL DEFAULT '',
  `districts_officer_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`districts_district_id`,`districts_officer_id`),
  KEY `districts_districts_officers__districts_officer_id` (`districts_officer_id`),
  CONSTRAINT `districts_districts_officers__districts_district_id` FOREIGN KEY (`districts_district_id`) REFERENCES `districts` (`districts_district_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `districts_districts_officers__districts_officer_id` FOREIGN KEY (`districts_officer_id`) REFERENCES `districts_officers` (`districts_officer_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `districts_officers`
--

DROP TABLE IF EXISTS `districts_officers`;

CREATE TABLE `districts_officers` (
  `districts_officer_id` int(11) unsigned NOT NULL,
  `attachments_attachment_id` int(11) unsigned DEFAULT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `position` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `mobile` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `show_image` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `params` text NOT NULL,
  `old_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`districts_officer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `districts_relations`
--

DROP TABLE IF EXISTS `districts_relations`;

CREATE TABLE `districts_relations` (
  `districts_relation_id` varchar(40) NOT NULL DEFAULT '',
  `districts_district_id` varchar(10) NOT NULL DEFAULT '',
  `streets_street_id` int(11) DEFAULT NULL,
  `range_start` int(11) NOT NULL DEFAULT '1',
  `range_end` int(11) NOT NULL DEFAULT '9999',
  `range_parity` varchar(250) NOT NULL,
  `islp` varchar(250) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`districts_relation_id`),
  KEY `districts_relations__districts_district_id` (`districts_district_id`),
  CONSTRAINT `districts_relations__districts_district_id` FOREIGN KEY (`districts_district_id`) REFERENCES `districts` (`districts_district_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Relations table for streets';


--
-- Table structure data for table `extensions`
--

DROP TABLE IF EXISTS `extensions`;

CREATE TABLE `extensions` (
  `extensions_extension_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`extensions_extension_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `files_containers`
--

DROP TABLE IF EXISTS `files_containers`;

CREATE TABLE `files_containers` (
  `files_container_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `parameters` text NOT NULL,
  PRIMARY KEY (`files_container_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `files_thumbnails`
--

DROP TABLE IF EXISTS `files_thumbnails`;

CREATE TABLE `files_thumbnails` (
  `files_thumbnail_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `files_container_id` varchar(255) NOT NULL,
  `folder` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `thumbnail` mediumtext NOT NULL,
  PRIMARY KEY (`files_thumbnail_id`),
  KEY `filename` (`filename`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `languages`
--

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
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


--
-- Table structure data for table `languages_tables`
--

DROP TABLE IF EXISTS `languages_tables`;

CREATE TABLE `languages_tables` (
  `languages_table_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `extensions_extension_id` int(11) unsigned DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `unique_column` varchar(64) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`languages_table_id`),
  KEY `languages_tables__extensions_extension_id` (`extensions_extension_id`),
  CONSTRAINT `languages_tables__extensions_extension_id` FOREIGN KEY (`extensions_extension_id`) REFERENCES `extensions` (`extensions_extension_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `languages_translations`
--

DROP TABLE IF EXISTS `languages_translations`;

CREATE TABLE `languages_translations` (
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


--
-- Table structure data for table `news`
--

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `news_article_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attachments_attachment_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` text NOT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `sticky` tinyint(1) DEFAULT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_by` int(11) unsigned DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  `publish_on` datetime DEFAULT NULL,
  `unpublish_on` datetime DEFAULT NULL,
  `params` text,
  PRIMARY KEY (`news_article_id`),
  KEY `idx_state` (`published`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Table structure data for table `pages`
--

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
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
  CONSTRAINT `pages__link_id` FOREIGN KEY (`link_id`) REFERENCES `pages` (`pages_page_id`) ON DELETE CASCADE,
  CONSTRAINT `pages__pages_menu_id` FOREIGN KEY (`pages_menu_id`) REFERENCES `pages_menus` (`pages_menu_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `pages_closures`
--

DROP TABLE IF EXISTS `pages_closures`;

CREATE TABLE `pages_closures` (
  `ancestor_id` int(11) unsigned NOT NULL,
  `descendant_id` int(11) unsigned NOT NULL,
  `level` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ancestor_id`,`descendant_id`),
  KEY `ix_level` (`level`),
  KEY `ix_descendant_id` (`descendant_id`),
  CONSTRAINT `pages_closures__ancestor_id` FOREIGN KEY (`ancestor_id`) REFERENCES `pages` (`pages_page_id`) ON DELETE CASCADE,
  CONSTRAINT `pages_closures__descendant_id` FOREIGN KEY (`descendant_id`) REFERENCES `pages` (`pages_page_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `pages_menus`
--

DROP TABLE IF EXISTS `pages_menus`;

CREATE TABLE `pages_menus` (
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


--
-- Table structure data for table `pages_modules`
--

DROP TABLE IF EXISTS `pages_modules`;

CREATE TABLE `pages_modules` (
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


--
-- Table structure data for table `pages_modules_pages`
--

DROP TABLE IF EXISTS `pages_modules_pages`;

CREATE TABLE `pages_modules_pages` (
  `pages_module_id` int(11) unsigned NOT NULL,
  `pages_page_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`pages_module_id`,`pages_page_id`),
  KEY `pages_modules_pages__pages_page_id` (`pages_page_id`),
  CONSTRAINT `pages_modules_pages__pages_module_id` FOREIGN KEY (`pages_module_id`) REFERENCES `pages_modules` (`pages_module_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pages_modules_pages__pages_page_id` FOREIGN KEY (`pages_page_id`) REFERENCES `pages` (`pages_page_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `pages_orderings`
--

DROP TABLE IF EXISTS `pages_orderings`;

CREATE TABLE `pages_orderings` (
  `pages_page_id` int(11) unsigned NOT NULL,
  `title` int(11) unsigned zerofill NOT NULL DEFAULT '00000000000',
  `custom` int(11) unsigned zerofill NOT NULL DEFAULT '00000000000',
  PRIMARY KEY (`pages_page_id`),
  KEY `ix_title` (`title`),
  KEY `ix_custom` (`custom`),
  CONSTRAINT `pages_orderings__pages_page_id` FOREIGN KEY (`pages_page_id`) REFERENCES `pages` (`pages_page_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `questions`
--

DROP TABLE IF EXISTS `questions`;

CREATE TABLE `questions` (
  `questions_question_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `categories_category_id` int(11) NOT NULL DEFAULT '0',
  `attachments_attachment_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `text` mediumtext NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(11) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(11) unsigned DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  `ordering` int(11) DEFAULT '0',
  `params` text,
  PRIMARY KEY (`questions_question_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `revisions`
--

DROP TABLE IF EXISTS `revisions`;

CREATE TABLE `revisions` (
  `table` varchar(64) NOT NULL,
  `row` bigint(20) unsigned NOT NULL,
  `revision` bigint(20) unsigned NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `data` longtext NOT NULL COMMENT '@Filter("json")',
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`table`,`row`,`revision`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `tags`
--

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `tags_tag_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `table` varchar(50) NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(10) unsigned DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`tags_tag_id`),
  UNIQUE KEY `slug` (`slug`),
  UNIQUE KEY `title` (`title`),
  KEY `table` (`table`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `tags_relations`
--

DROP TABLE IF EXISTS `tags_relations`;

CREATE TABLE `tags_relations` (
  `tags_tag_id` bigint(20) unsigned NOT NULL,
  `row` bigint(20) unsigned NOT NULL,
  `table` varchar(255) NOT NULL,
  PRIMARY KEY (`tags_tag_id`,`row`,`table`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `traffic`
--

DROP TABLE IF EXISTS `traffic`;

CREATE TABLE `traffic` (
  `traffic_article_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `categories_category_id` int(11) DEFAULT NULL,
  `title` varchar(250) NOT NULL DEFAULT '',
  `slug` varchar(255) DEFAULT NULL,
  `text` text NOT NULL,
  `start_on` datetime DEFAULT NULL,
  `end_on` datetime DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(11) DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  PRIMARY KEY (`traffic_article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `traffic_streets`
--

DROP TABLE IF EXISTS `traffic_streets`;

CREATE TABLE `traffic_streets` (
  `streets_street_id` int(11) unsigned NOT NULL,
  `traffic_article_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`streets_street_id`,`traffic_article_id`),
  KEY `traffic_streets__traffic_article_id` (`traffic_article_id`),
  CONSTRAINT `traffic_streets__traffic_article_id` FOREIGN KEY (`traffic_article_id`) REFERENCES `traffic` (`traffic_article_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Relations table for streets';


--
-- Table structure data for table `uploads`
--

DROP TABLE IF EXISTS `uploads`;

CREATE TABLE `uploads` (
  `uploads_upload_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `table` int(11) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uploads_upload_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `users`
--

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
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
  CONSTRAINT `users_user_role` FOREIGN KEY (`users_role_id`) REFERENCES `users_roles` (`users_role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `users_group_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`users_group_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `users_groups_users`
--

DROP TABLE IF EXISTS `users_groups_users`;

CREATE TABLE `users_groups_users` (
  `users_group_id` int(11) unsigned NOT NULL,
  `users_user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`users_group_id`,`users_user_id`),
  KEY `users_groups_users__users_user_id` (`users_user_id`),
  CONSTRAINT `users_groups_users__users_group_id` FOREIGN KEY (`users_group_id`) REFERENCES `users_groups` (`users_group_id`) ON DELETE CASCADE,
  CONSTRAINT `users_groups_users__users_user_id` FOREIGN KEY (`users_user_id`) REFERENCES `users` (`users_user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `users_passwords`
--

DROP TABLE IF EXISTS `users_passwords`;

CREATE TABLE `users_passwords` (
  `email` varchar(100) NOT NULL DEFAULT '',
  `expiration` date DEFAULT NULL,
  `hash` varchar(100) NOT NULL DEFAULT '',
  `reset` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`email`),
  CONSTRAINT `users_password__email` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `users_roles`
--

DROP TABLE IF EXISTS `users_roles`;

CREATE TABLE `users_roles` (
  `users_role_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`users_role_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `users_sessions`
--

DROP TABLE IF EXISTS `users_sessions`;

CREATE TABLE `users_sessions` (
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


--
-- Create database `data`
--

DROP DATABASE IF EXISTS `data`;

CREATE DATABASE `data`;


--
-- Table structure data for table `data`.`police_municipalities`
--

DROP TABLE IF EXISTS `data`.`police_municipalities`;

CREATE TABLE `data`.`police_municipalities` (
  `police_municipality_id` int(20) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `police_zone_id` int(11) NOT NULL DEFAULT '0',
  `postcode` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `iso_code` varchar(250) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`police_municipality_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2775 DEFAULT CHARSET=utf8;


--
-- Table structure data for table `data`.`police_zones`
--

DROP TABLE IF EXISTS `data`.`police_zones`;

CREATE TABLE `data`.`police_zones` (
  `police_zone_id` int(11) unsigned NOT NULL,
  `title` varchar(250) NOT NULL DEFAULT '',
  `language` int(11) NOT NULL,
  `phone_emergency` varchar(250) DEFAULT NULL,
  `phone_information` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `chief_name` varchar(250) NOT NULL,
  `chief_email` varchar(250) NOT NULL,
  `twitter` varchar(250) DEFAULT NULL,
  `facebook` varchar(250) DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`police_zone_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `data`.`streets`
--

DROP TABLE IF EXISTS `data`.`streets`;

CREATE TABLE `data`.`streets` (
  `streets_street_id` int(11) unsigned NOT NULL,
  `streets_city_id` int(5) DEFAULT NULL,
  `title` varchar(80) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `title2` varchar(80) DEFAULT NULL,
  `language1` varchar(2) DEFAULT NULL,
  `language2` varchar(2) DEFAULT NULL,
  `language3` varchar(2) DEFAULT NULL,
  `title0` varchar(80) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(11) DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  PRIMARY KEY (`streets_street_id`),
  KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `data`.`streets_cities`
--

DROP TABLE IF EXISTS `data`.`streets_cities`;

CREATE TABLE `data`.`streets_cities` (
  `streets_city_id` int(11) unsigned NOT NULL,
  `title` varchar(40) DEFAULT NULL,
  `language` varchar(2) DEFAULT NULL,
  `police_zone_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`streets_city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `support_tickets`
--

DROP TABLE IF EXISTS `support_tickets`;

CREATE TABLE `support_tickets` (
  `support_ticket_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `text` text NOT NULL,
  `status` varchar(25) DEFAULT 'new',
  `created_by` int(10) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(11) DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  PRIMARY KEY (`support_ticket_id`),
  KEY `created_on` (`created_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `data`.`support_announcements`
--

DROP TABLE IF EXISTS `data`.`support_announcements`;

CREATE TABLE `data`.`support_announcements` (
  `support_announcement_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `text` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(10) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(11) DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  PRIMARY KEY (`support_announcement_id`),
  KEY `idx_enabled` (`published`),
  KEY `created_on` (`created_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure data for table `support_announcements`
--

DROP VIEW IF EXISTS `support_announcements`;

CREATE VIEW `support_announcements` AS
SELECT *
FROM `data`.`support_announcements`;


SET SQL_MODE=@OLD_SQL_MODE;
SET TIME_ZONE=@OLD_TIME_ZONE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;