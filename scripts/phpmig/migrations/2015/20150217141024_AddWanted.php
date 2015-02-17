<?php

use MyPhpmig\Police\Migration;

class AddWanted extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = <<<END

CREATE TABLE `wanted` (
  `wanted_article_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wanted_category_id` int(11) DEFAULT NULL,
  `attachments_attachment_id` int(11) unsigned NOT NULL DEFAULT '0',
  `streets_city_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `text` mediumtext NOT NULL,
  `date` date DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(11) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(11) unsigned DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  `params` text,
  PRIMARY KEY (`wanted_article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'wanted_categories'
CREATE TABLE `wanted_categories` (
  `wanted_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `wanted_section_id` int(11) NOT NULL DEFAULT '0',
  `attachments_attachment_id` int(11) unsigned NOT NULL DEFAULT '0',
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
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`wanted_category_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `cat_idx` (`published`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'wanted_sections'
CREATE TABLE `wanted_sections` (
  `wanted_section_id` int(11) NOT NULL AUTO_INCREMENT,
  `attachments_attachment_id` int(11) unsigned NOT NULL DEFAULT '0',
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
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`wanted_section_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `cat_idx` (`published`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
VALUES
	(117, 1, 0, 'Wanted', 'wanted', 'option=com_wanted&view=sections', NULL, 'component', 0, 0, 0, 49, 1, '2015-02-17 14:06:24', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"'),
	(118, 2, 0, 'Wanted', 'wanted', 'option=com_wanted&view=articles', NULL, 'component', 0, 0, 0, 49, 1, '2015-02-17 14:07:56', NULL, NULL, NULL, NULL, 0, '');

INSERT INTO `pages_closures` (`ancestor_id`, `descendant_id`, `level`)
VALUES
	(117, 117, 0),
	(4, 118, 1),
	(118, 118, 0);

INSERT INTO `pages_orderings` (`pages_page_id`, `title`, `custom`)
VALUES
	(117, 00000000007, 00000000004),
	(118, 00000000010, 00000000013);

INSERT INTO `extensions` (`extensions_extension_id`, `title`, `name`, `params`, `enabled`)
VALUES
	(49, 'Wanted', 'com_wanted', '', 1);

END;

        parent::up();

        // All the Dutch and multilingual zones.
        $this->getZones()->where('language', '=', 1)->where('language', '=', 3, 'OR');

        $this->_queries = "UPDATE `pages` SET `title` = 'Opsporingen' WHERE `pages_page_id` IN ('118');";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Opsporingen' WHERE `pages_page_id` IN ('117');";
        $this->_queries .= "UPDATE `pages` SET `slug` = 'opsporingen' WHERE `pages_page_id` IN ('117');";

        parent::up();


        // All the French speaking zones.
        $this->getZones()->reset()->where('language', '=', 2);

        $this->_queries = "UPDATE `pages` SET `title` = 'Avis de recherche' WHERE `pages_page_id` IN ('118');";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Avis de recherche' WHERE `pages_page_id` IN ('117');";
        $this->_queries .= "UPDATE `pages` SET `slug` = 'avis-de-recherche' WHERE `pages_page_id` IN ('117');";

        parent::up();

        // All multilingual zones.
        $this->getZones()->where('language', '=', 3);

        $this->_queries = <<<END

INSERT INTO `fr-be_pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
VALUES
	(117, 1, 0, 'Avis de recherche', 'avis-de-recherche', 'option=com_wanted&view=sections', NULL, 'component', 0, 0, 0, 49, 1, '2015-02-17 14:06:24', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"'),
	(118, 2, 0, 'Avis de recherche', 'wanted', 'option=com_wanted&view=articles', NULL, 'component', 0, 0, 0, 49, 1, '2015-02-17 14:07:56', NULL, NULL, NULL, NULL, 0, '');

INSERT INTO `languages_translations` (`languages_translation_id`, `iso_code`, `table`, `row`, `slug`, `status`, `original`, `deleted`)
VALUES
	(0, 'nl-be', 'pages', 117, 'opsporingen', 1, 1, 0),
	(0, 'fr-be', 'pages', 117, 'avis-de-recherche', 3, 0, 0),
	(0, 'nl-be', 'pages', 118, 'wanted', 1, 1, 0),
	(0, 'fr-be', 'pages', 118, 'wanted', 3, 0, 0);

END;

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "DROP TABLE IF EXISTS `wanted`;";
        $this->_queries .= "DROP TABLE IF EXISTS `wanted_categories`;";
        $this->_queries .= "DROP TABLE IF EXISTS `wanted_sections`;";

        $this->_queries .= "DELETE FROM `extensions` WHERE `extensions_extension_id` IN ('49');";
        $this->_queries .= "DELETE FROM `pages` WHERE `pages_page_id` IN ('117', '118');";

        parent::down();


        // All multilingual zones.
        $this->getZones()->where('language', '=', 3);

        $this->_queries = "DELETE FROM `fr-be_pages` WHERE `pages_page_id` IN ('117', '118');";

        parent::down();
    }
}
