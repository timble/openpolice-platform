<?php

use MyPhpmig\Police\Migration;

class AddComFound extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = <<<END
-- Create syntax for TABLE 'found'
CREATE TABLE `found` (
  `found_item_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `found_category_id` int(11) NOT NULL DEFAULT '0',
  `contacts_contact_id` int(11) DEFAULT NULL,
  `attachments_attachment_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `text` mediumtext NOT NULL,
  `found_on` date DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(11) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(11) unsigned DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  `params` text,
  PRIMARY KEY (`found_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `extensions` (`extensions_extension_id`, `title`, `name`, `params`, `enabled`) VALUES (NULL, 'Found', 'com_found', '', '1');

INSERT INTO `pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
VALUES
	(115, 2, 0, 'Found', 'found', 'option=com_found&view=items', NULL, 'component', 1, 0, 0, 48, 1, '2015-01-30 15:15:12', NULL, NULL, NULL, NULL, 0, ''),
	(116, 2, 0, 'Items', 'items', 'option=com_found&view=items', NULL, 'component', 1, 0, 0, 48, 1, '2015-01-30 15:15:24', NULL, NULL, NULL, NULL, 0, ''),
	(117, 2, 0, 'Categories', 'categories', 'option=com_found&view=categories', NULL, 'component', 1, 0, 0, 48, 1, '2015-01-30 15:15:39', NULL, NULL, NULL, NULL, 0, ''),
	(118, 1, 0, 'Found', 'found-items', 'option=com_found&view=items', NULL, 'component', 1, 1, 0, 48, 1, '2015-01-30 15:48:04', NULL, NULL, NULL, NULL, 0, 'page_title=\"Gevonden voorwerpen\"');

INSERT INTO `pages_closures` (`ancestor_id`, `descendant_id`, `level`)
VALUES
	(115, 115, 0),
	(115, 116, 1),
	(115, 117, 1),
	(116, 116, 0),
	(117, 117, 0),
	(118, 118, 0);


INSERT INTO `pages_orderings` (`pages_page_id`, `title`, `custom`)
VALUES
	(115, 00000000004, 00000000012),
	(116, 00000000002, 00000000001),
	(117, 00000000001, 00000000002),
	(118, 00000000004, 00000000012);

END;

        parent::up();


        // All the Dutch and multilingual zones.
        $this->getZones()->where('language', '=', 1)->where('language', '=', 3, 'OR');

        $this->_queries = "UPDATE `pages` SET `title` = 'Gevonden' WHERE `pages_page_id` IN ('115');";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Voorwerpen' WHERE `pages_page_id` IN ('116');";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Categorieën' WHERE `pages_page_id` IN ('117');";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Gevonden' WHERE `pages_page_id` IN ('118');";
        $this->_queries .= "UPDATE `pages` SET `slug` = 'gevonden-voorwerpen' WHERE `pages_page_id` IN ('118');";

        parent::up();


        // All the French speaking zones.
        $this->getZones()->reset()->where('language', '=', 2);

        $this->_queries = "UPDATE `pages` SET `title` = 'Trouvés' WHERE `pages_page_id` IN ('115');";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Objects' WHERE `pages_page_id` IN ('116');";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Catégories' WHERE `pages_page_id` IN ('117');";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Trouvés' WHERE `pages_page_id` IN ('118');";
        $this->_queries .= "UPDATE `pages` SET `slug` = 'objects-trouves' WHERE `pages_page_id` IN ('118');";

        parent::up();


        // All multilingual zones.
        $this->getZones()->where('language', '=', 3);

        $this->_queries = <<<END

INSERT INTO `fr-be_pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
VALUES
	(115, 2, 0, 'Trouvés', 'found', 'option=com_found&view=items', NULL, 'component', 1, 0, 0, 48, 1, '2015-01-30 15:15:12', NULL, NULL, NULL, NULL, 0, ''),
	(116, 2, 0, 'Objects', 'items', 'option=com_found&view=items', NULL, 'component', 1, 0, 0, 48, 1, '2015-01-30 15:15:24', NULL, NULL, NULL, NULL, 0, ''),
	(117, 2, 0, 'Catégories', 'categories', 'option=com_found&view=categories', NULL, 'component', 1, 0, 0, 48, 1, '2015-01-30 15:15:39', NULL, NULL, NULL, NULL, 0, ''),
	(118, 1, 0, 'Trouvés', 'objects-trouves', 'option=com_found&view=items', NULL, 'component', 1, 1, 0, 48, 1, '2015-01-30 15:48:04', NULL, NULL, NULL, NULL, 0, 'page_title=\"Gevonden voorwerpen\"');

INSERT INTO `languages_translations` (`languages_translation_id`, `iso_code`, `table`, `row`, `slug`, `status`, `original`, `deleted`)
VALUES
	(0, 'nl-be', 'pages', 115, 'found', 1, 1, 0),
	(0, 'fr-be', 'pages', 115, 'found', 3, 0, 0),
	(0, 'nl-be', 'pages', 116, 'items', 1, 1, 0),
	(0, 'fr-be', 'pages', 116, 'items', 3, 0, 0),
	(0, 'nl-be', 'pages', 117, 'categories', 1, 1, 0),
	(0, 'fr-be', 'pages', 117, 'categories', 3, 0, 0),
	(0, 'nl-be', 'pages', 118, 'gevonden-voorwerpen', 1, 1, 0),
	(0, 'fr-be', 'pages', 118, 'objects-trouves', 3, 0, 0);

END;

        parent::up();


        $this->getZones()->set(array('data' => 'Data'));

        $this->_queries = <<<END

-- Create syntax for TABLE 'found_categories'
CREATE TABLE `found_categories` (
  `found_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(10) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(10) unsigned DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`found_category_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `cat_idx` (`published`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

END;

        parent::up();

    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "DROP TABLE IF EXISTS `found`;";

        $this->_queries .= "DELETE FROM `extensions` WHERE `extensions_extension_id` IN ('48');";
        $this->_queries .= "DELETE FROM `pages` WHERE `pages_page_id` IN ('115', '116', '117', '118');";

        parent::down();


        // All multilingual zones.
        $this->getZones()->where('language', '=', 3);

        $this->_queries = "DELETE FROM `fr-be_pages` WHERE `pages_page_id` IN ('115', '116', '117', '118');";

        parent::down();


        $this->getZones()->set(array('data' => 'Data'));

        $this->_queries = "DROP TABLE IF EXISTS `found_categories`;";

        parent::down();
    }
}
