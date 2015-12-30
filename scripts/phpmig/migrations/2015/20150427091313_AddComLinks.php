<?php

use MyPhpmig\Police\Migration;

class AddComLinks extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        // All multilingual zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = <<<END

INSERT INTO `pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
VALUES
	(120, 1, 0, 'Links', 'links', 'option=com_links&view=links', NULL, 'component', 1, 0, 0, 51, 1, '2015-04-27 09:11:25', NULL, NULL, NULL, NULL, 0, '');

INSERT INTO `languages_translations` (`languages_translation_id`, `iso_code`, `table`, `row`, `slug`, `status`, `original`, `deleted`)
VALUES
	(0, 'nl-be', 'pages', 120, 'links', 1, 1, 0),
	(0, 'fr-be', 'pages', 120, 'links', 3, 0, 0);

END;

        parent::up();


        // Fed website.
        $this->getZones()->reset()->where('language', '=', 7);

        $this->_queries = <<<END

INSERT INTO `fr-be_pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
VALUES
	(120, 2, 0, 'Links', 'links', 'option=com_links&view=links', NULL, 'component', 1, 0, 0, 51, 1, '2015-04-27 09:11:25', NULL, NULL, NULL, NULL, 0, '');

INSERT INTO `de-be_pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
VALUES
	(120, 2, 0, 'Links', 'links', 'option=com_links&view=links', NULL, 'component', 1, 0, 0, 51, 1, '2015-04-27 09:11:25', NULL, NULL, NULL, NULL, 0, '');


INSERT INTO `languages_translations` (`languages_translation_id`, `iso_code`, `table`, `row`, `slug`, `status`, `original`, `deleted`)
VALUES
	(0, 'nl-be', 'pages', 120, 'links', 1, 1, 0),
	(0, 'de-be', 'pages', 120, 'links', 3, 0, 0),
	(0, 'fr-be', 'pages', 120, 'links', 3, 0, 0);

END;

        parent::up();


        // Target `manager` database
        $this->getZones()->set(array('manager' => 'Manager'));

        $this->_queries = <<<EOL

INSERT INTO `extensions` (`extensions_extension_id`, `title`, `name`, `params`, `enabled`)
VALUES
    (6, 'Links', 'com_links', '', 1);
";

INSERT INTO `pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
VALUES
	(10, 1, 0, 'Links', 'links', 'option=com_links&view=links', NULL, 'component', 1, 0, 0, 6, 1, '2015-04-27 09:11:25', NULL, NULL, NULL, NULL, 0, '');

INSERT INTO `pages_closures` (`ancestor_id`, `descendant_id`, `level`)
VALUES
	(10, 10, 0);

INSERT INTO `pages_orderings` (`pages_page_id`, `title`, `custom`)
VALUES
	(10, 00000000005, 00000000005);

EOL;

        parent::up();


        // Target `data` database
        $this->getZones()->set(array('data' => 'Data'));

        $this->_queries = <<<EOL

CREATE TABLE `links` (
  `links_link_id` varchar(255) NOT NULL DEFAULT '0',
  `police_zone_id` varchar(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT '0',
  `crawled` tinyint(1) NOT NULL DEFAULT '0',
  `internal` tinyint(1) NOT NULL DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `last_crawled_on` datetime DEFAULT NULL,
  `last_checked_on` datetime DEFAULT NULL,
  PRIMARY KEY (`links_link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'links_relations'
CREATE TABLE `links_relations` (
  `links_link_id` varchar(255) NOT NULL DEFAULT '',
  `linked_on` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `links_link_id` (`links_link_id`,`linked_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

EOL;

        parent::up();

    }

    /**
     * Undo the migration
     */
    public function down()
    {
        // All zones.
        $this->_queries .= "DELETE FROM `extensions` WHERE `extensions_extension_id` IN ('51');";
        $this->_queries .= "DELETE FROM `pages` WHERE `pages_page_id` IN ('120');";

        parent::down();

        // All multilingual zones.
        $this->getZones()->where('language', '=', 3);

        $this->_queries = "DELETE FROM `fr-be_pages` WHERE `pages_page_id` IN ('120');";

        parent::down();

        // Fed site.
        $this->getZones()->where('language', '=', 7);

        $this->_queries = "DELETE FROM `fr-be_pages` WHERE `pages_page_id` IN ('120');";
        $this->_queries .= "DELETE FROM `de-be_pages` WHERE `pages_page_id` IN ('120');";

        parent::down();

        // Target `data` database
        $this->getZones()->set(array('data' => 'Data'));

        $this->_queries = "ALTER TABLE `users` DROP `links`;";
        $this->_queries .= "ALTER TABLE `users` DROP `links_relations`;";

        parent::down();

        // Target `manager` database
        $this->getZones()->set(array('manager' => 'Manager'));

        $this->_queries = "DELETE FROM `pages` WHERE `pages_page_id` IN ('10');";
        $this->_queries .= "DELETE FROM `extensions` WHERE `extensions_extension_id` IN ('6');";

        parent::down();
    }
}
