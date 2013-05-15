-- Create syntax for TABLE 'districts_districts'
CREATE TABLE `districts` (
  `districts_district_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `districts_district_code` varchar(250) NOT NULL,
  `contacts_contact_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`districts_district_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'districts_districts_officers'
CREATE TABLE `districts_districts_officers` (
  `districts_district_id` int(11) unsigned NOT NULL,
  `districts_officer_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`districts_district_id`,`districts_officer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'districts_officers'
CREATE TABLE `districts_officers` (
  `districts_officer_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `position` varchar(250) NOT NULL,
  `number` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `mobile` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `params` text NOT NULL,
  PRIMARY KEY (`districts_officer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'districts_relations'
CREATE TABLE `districts_relations` (
  `districts_relation_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `districts_district_id` int(11) NOT NULL,
  `districts_district_code` varchar(250) NOT NULL,
  `range_start` int(11) NOT NULL DEFAULT '1',
  `range_end` int(11) NOT NULL DEFAULT '9999',
  `range_parity` varchar(250) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`districts_relation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Relations table for streets';


CREATE TABLE `news` (
  `news_article_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `sticky` tinyint(1) DEFAULT '0',
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
  PRIMARY KEY (`news_article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Create syntax for TABLE 'police_municipalities'
CREATE TABLE `police_municipalities` (
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

-- Create syntax for TABLE 'police_zones'
CREATE TABLE `police_zones` (
  `police_zone_id` int(11) unsigned NOT NULL,
  `title` varchar(250) NOT NULL DEFAULT '',
  `language` int(11) NOT NULL,
  `telephone` varchar(250) DEFAULT NULL,
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


CREATE TABLE `questions` (
  `questions_article_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `categories_category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `text` mediumtext NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(11) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(11) unsigned DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  `ordering` int(11) DEFAULT '0',
  `params` text,
  PRIMARY KEY (`questions_article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Create syntax for TABLE 'streets_streets'
CREATE TABLE `streets` (
  `streets_street_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `zone_street_code` varchar(250) NOT NULL DEFAULT '',
  `police_municipality_id` int(11) NOT NULL,
  `police_city_code` int(11) DEFAULT NULL,
  `title` varchar(250) NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `postcode` int(11) NOT NULL DEFAULT '0',
  `published` int(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`streets_street_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'streets_relations'
CREATE TABLE `streets_relations` (
  `streets_street_id` bigint(20) unsigned NOT NULL,
  `row` bigint(20) unsigned NOT NULL,
  `table` varchar(255) NOT NULL,
  PRIMARY KEY (`streets_street_id`,`row`,`table`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Relations table for streets';



CREATE TABLE `traffic_controls` (
  `traffic_control_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`traffic_control_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `traffic_measures` (
  `traffic_measure_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`traffic_measure_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- Create syntax for TABLE 'trafficinfo_categories'
CREATE TABLE `trafficinfo_categories` (
  `trafficinfo_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(10) unsigned DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  PRIMARY KEY (`trafficinfo_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'trafficinfo_events'
CREATE TABLE `trafficinfo_events` (
  `trafficinfo_event_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `trafficinfo_category_id` int(11) DEFAULT NULL,
  `trafficinfo_item_id_incident` int(11) DEFAULT NULL,
  `trafficinfo_item_id_place` int(11) DEFAULT NULL,
  `trafficinfo_item_id_place_direction` int(11) DEFAULT NULL,
  `trafficinfo_item_id_place_end` int(11) DEFAULT NULL,
  `trafficinfo_item_id_road` int(11) DEFAULT NULL,
  `trafficinfo_item_id_road_bis` int(11) DEFAULT NULL,
  `trafficinfo_item_id_situation` int(11) DEFAULT NULL,
  `trafficinfo_item_id_source` int(11) DEFAULT NULL,
  `trafficinfo_item_id_traffic` int(11) DEFAULT NULL,
  `title` varchar(250) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `information` text NOT NULL,
  `densities` text,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`trafficinfo_event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'trafficinfo_items'
CREATE TABLE `trafficinfo_items` (
  `trafficinfo_item_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group` enum('incident','situation','traffic','source','roads','places','text') NOT NULL DEFAULT 'incident',
  `title` varchar(250) NOT NULL DEFAULT '',
  `title_fr` varchar(250) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`trafficinfo_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;