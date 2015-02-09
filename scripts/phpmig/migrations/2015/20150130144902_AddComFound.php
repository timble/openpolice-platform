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
  `contacts_contact_id` int(11) DEFAULT NULL,
  `attachments_attachment_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `text` mediumtext NOT NULL,
  `found_on` date DEFAULT NULL,
  `tracking_number` int(11) DEFAULT NULL,
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
	(115, 2, 0, 'Found', 'found', 'option=com_found&view=items', NULL, 'component', 0, 0, 0, 48, 1, '2015-01-30 15:15:12', NULL, NULL, NULL, NULL, 0, ''),
	(116, 1, 0, 'Found', 'found-items', 'option=com_found&view=items', NULL, 'component', 0, 1, 0, 48, 1, '2015-01-30 15:48:04', NULL, NULL, NULL, NULL, 0, '');

INSERT INTO `pages_closures` (`ancestor_id`, `descendant_id`, `level`)
VALUES
	(4, 115, 1),
	(115, 115, 0),
	(116, 116, 0);



INSERT INTO `pages_orderings` (`pages_page_id`, `title`, `custom`)
VALUES
	(115, 00000000004, 00000000012),
	(116, 00000000004, 00000000012);

END;

        parent::up();


        // All the Dutch and multilingual zones.
        $this->getZones()->where('language', '=', 1)->where('language', '=', 3, 'OR');

        $this->_queries = "UPDATE `pages` SET `title` = 'Gevonden' WHERE `pages_page_id` IN ('115');";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Gevonden' WHERE `pages_page_id` IN ('116');";
        $this->_queries .= "UPDATE `pages` SET `slug` = 'gevonden-voorwerpen' WHERE `pages_page_id` IN ('116');";

        parent::up();


        // All the French speaking zones.
        $this->getZones()->reset()->where('language', '=', 2);

        $this->_queries = "UPDATE `pages` SET `title` = 'Trouvés' WHERE `pages_page_id` IN ('115');";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Trouvés' WHERE `pages_page_id` IN ('116');";
        $this->_queries .= "UPDATE `pages` SET `slug` = 'objects-trouves' WHERE `pages_page_id` IN ('116');";

        parent::up();


        // All multilingual zones.
        $this->getZones()->where('language', '=', 3);

        $this->_queries = <<<END

INSERT INTO `fr-be_pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
VALUES
	(115, 2, 0, 'Trouvés', 'found', 'option=com_found&view=items', NULL, 'component', 0, 0, 0, 48, 1, '2015-01-30 15:15:12', NULL, NULL, NULL, NULL, 0, ''),
	(116, 1, 0, 'Trouvés', 'objects-trouves', 'option=com_found&view=items', NULL, 'component', 0, 1, 0, 48, 1, '2015-01-30 15:48:04', NULL, NULL, NULL, NULL, 0, '');

INSERT INTO `languages_translations` (`languages_translation_id`, `iso_code`, `table`, `row`, `slug`, `status`, `original`, `deleted`)
VALUES
	(0, 'nl-be', 'pages', 115, 'found', 1, 1, 0),
	(0, 'fr-be', 'pages', 115, 'found', 3, 0, 0),
	(0, 'nl-be', 'pages', 116, 'gevonden-voorwerpen', 1, 1, 0),
	(0, 'fr-be', 'pages', 116, 'objects-trouves', 3, 0, 0);

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
        $this->_queries .= "DELETE FROM `pages` WHERE `pages_page_id` IN ('115', '116');";

        parent::down();


        // All multilingual zones.
        $this->getZones()->where('language', '=', 3);

        $this->_queries = "DELETE FROM `fr-be_pages` WHERE `pages_page_id` IN ('115', '116');";

        parent::down();
    }
}
