-- Create syntax for TABLE 'categories'
CREATE TABLE `fora_categories` (
  `fora_category_id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`fora_category_id`),
  UNIQUE KEY `slug` (`slug`,`table`),
  KEY `cat_idx` (`table`,`published`,`access`),
  KEY `idx_access` (`access`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'fora_forums'
CREATE TABLE `fora_forums` (
  `fora_forum_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `fora_category_id` int(11) NOT NULL,
  `type` enum('article','issue','question','idea') DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `text` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  `locked_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`fora_forum_id`),
  KEY `idx_enabled` (`published`),
  KEY `idx_category_id` (`fora_category_id`),
  CONSTRAINT `fora_forums_ibfk_1` FOREIGN KEY (`fora_category_id`) REFERENCES `fora_categories` (`fora_category_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'fora_responds'
CREATE TABLE `fora_responds` (
  `fora_topic_id` int(11) unsigned NOT NULL,
  `comments_comment_id` int(11) NOT NULL,
  PRIMARY KEY (`fora_topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'fora_subscriptions'
CREATE TABLE `fora_subscriptions` (
  `type` enum('topic','forum') NOT NULL DEFAULT 'topic',
  `row` int(10) unsigned NOT NULL,
  `site` varchar(30) NOT NULL DEFAULT '',
  `users_user_id` int(10) unsigned NOT NULL,
  `last_viewed_on` datetime DEFAULT NULL,
  `notification_sent_on` datetime DEFAULT NULL,
  PRIMARY KEY (`type`,`row`,`site`,`users_user_id`),
  KEY `idx_type_row` (`type`,`row`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'fora_topics'
CREATE TABLE `fora_topics` (
  `fora_topic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fora_forum_id` smallint(5) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `text` text NOT NULL,
  `votes` smallint(6) DEFAULT NULL,
  `hits` int(11) DEFAULT '0',
  `comments_comment_id` int(11) unsigned NOT NULL,
  `commentable` tinyint(1) NOT NULL DEFAULT '1',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `status` varchar(25) DEFAULT NULL,
  `sticky` tinyint(1) NOT NULL DEFAULT '0',
  `latest_activity_on` datetime DEFAULT NULL,
  `last_commented_by` int(10) DEFAULT NULL,
  `last_commented_by_name` varchar(100) DEFAULT NULL,
  `total_comments` smallint(6) DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(10) unsigned DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  PRIMARY KEY (`fora_topic_id`),
  KEY `idx_forum_id` (`fora_forum_id`),
  KEY `idx_enabled` (`published`),
  KEY `created_on` (`created_on`),
  CONSTRAINT `fora_topics_ibfk_1` FOREIGN KEY (`fora_forum_id`) REFERENCES `fora_forums` (`fora_forum_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'fora_votes'
CREATE TABLE `fora_votes` (
  `fora_topic_id` int(10) unsigned NOT NULL,
  `users_user_id` int(10) unsigned NOT NULL,
  `site` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`fora_topic_id`,`users_user_id`),
  CONSTRAINT `fora_votes_ibfk_1` FOREIGN KEY (`fora_topic_id`) REFERENCES `fora_topics` (`fora_topic_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;