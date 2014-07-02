<?php

use MyPhpmig\Police\Migration;

class AddBin extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "INSERT INTO `extensions` (`extensions_extension_id`, `title`, `name`, `params`, `enabled`) VALUES ('46', 'BIN', 'com_bin', '', '1');";

        $this->_queries .= "CREATE TABLE `bin_districts` (
                          `bin_district_id` varchar(250) NOT NULL DEFAULT '',
                          `title` varchar(250) NOT NULL DEFAULT '',
                          `slug` varchar(255) NOT NULL DEFAULT '',
                          `twitter` varchar(250) NOT NULL,
                          `facebook` varchar(250) NOT NULL,
                          `coordinator_firstname` varchar(250) NOT NULL,
                          `coordinator_lastname` varchar(250) NOT NULL DEFAULT '',
                          `coordinator_phone` varchar(250) NOT NULL,
                          `coordinator_mobile` varchar(250) NOT NULL,
                          `coordinator_address` varchar(250) NOT NULL,
                          `coordinator_suburb` varchar(250) NOT NULL,
                          `coordinator_postcode` varchar(250) NOT NULL,
                          `coordinator_email` varchar(250) NOT NULL,
                          `created_by` int(11) NOT NULL DEFAULT '0',
                          `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                          `modified_by` int(11) NOT NULL DEFAULT '0',
                          `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                          `locked_by` int(11) NOT NULL DEFAULT '0',
                          `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                          PRIMARY KEY (`bin_district_id`),
                          UNIQUE KEY `slug` (`slug`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        $this->_queries .= "CREATE TABLE `bin_relations` (
                          `bin_relation_id` varchar(40) NOT NULL DEFAULT '',
                          `bin_district_id` varchar(10) NOT NULL DEFAULT '',
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
                          PRIMARY KEY (`bin_relation_id`),
                          KEY `bin_relations__bin_district_id` (`bin_district_id`),
                          CONSTRAINT `bin_relations__bin_district_id` FOREIGN KEY (`bin_district_id`) REFERENCES `bin_districts` (`bin_district_id`) ON DELETE CASCADE ON UPDATE CASCADE
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Relations table for streets';";

        $this->_queries .= "INSERT INTO `pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
                            VALUES
                                (102, 2, 0, 'BIN', 'bin', 'option=com_bin&view=districts', NULL, 'component', 0, 0, 0, 46, 1, '2014-06-11 09:24:40', NULL, NULL, NULL, NULL, 0, ''),
                                (103, 2, 0, 'Districts', 'districts', 'option=com_bin&view=districts', NULL, 'component', 0, 0, 0, 46, 1, '2014-06-11 09:24:50', NULL, NULL, NULL, NULL, 0, ''),
                                (104, 2, 0, 'Relations', 'relations', 'option=com_bin&view=relations', NULL, 'component', 0, 0, 0, 46, 1, '2014-06-11 09:25:13', NULL, NULL, NULL, NULL, 0, ''),
                                (105, 1, 0, 'Neighborhood information network', 'neighborhood-information-network', 'option=com_bin&view=relations', NULL, 'component', 0, 0, 0, 46, 1, '2014-06-11 09:48:59', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"');
                            ";

        $this->_queries .= "INSERT INTO `pages_closures` (`ancestor_id`, `descendant_id`, `level`)
                            VALUES
                                (4, 102, 1),
                                (102, 102, 0),
                                (102, 103, 1),
                                (4, 103, 2),
                                (103, 103, 0),
                                (104, 104, 0),
                                (102, 104, 1),
                                (4, 104, 2),
                                (41, 105, 1),
                                (105, 105, 0);
                            ";

        $this->_queries .= "INSERT INTO `pages_orderings` (`pages_page_id`, `title`, `custom`)
                            VALUES
                                (102, 00000000002, 00000000011),
                                (103, 00000000001, 00000000001),
                                (104, 00000000002, 00000000002),
                                (105, 00000000004, 00000000005);
                            ";

        $this->_queries .= "INSERT INTO `pages_modules_pages` (`pages_module_id`, `pages_page_id`)
                            VALUES
                                (2, 105);
                            ";

        $this->_queries .= "INSERT INTO `categories` (`categories_category_id`, `parent_id`, `attachments_attachment_id`, `title`, `slug`, `image`, `table`, `description`, `published`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `ordering`, `access`, `params`)
                            VALUES
                                (0, 0, 0, 'Neighborhood information network', 'neighborhood-information-network', '', 'bin', '<p>Het Buurt Informatie Netwerk – kortweg BIN – is een samenwerkingsverband tussen bewoners, politie en gemeente met als doelstelling de veiligheid en leefbaarheid in een wijk te verbeteren.</p>\n<p>Help mee en meld u aan bij de BIN-coördinator van uw wijk. Samen met uw buurgenoten werkt u aan een veilige en sociale buurt.</p>', 0, 1, '2014-06-11 13:11:38', NULL, NULL, NULL, NULL, 1, 0, '');
                            ";

        parent::up();

        // All the Dutch and multilingual zones.
        $this->getZones()->where('language', '=', 1)->where('language', '=', 3, 'OR');

        $this->_queries = "UPDATE `pages` SET `title` = 'BIN' WHERE `pages_page_id` IN ('102');";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Wijken' WHERE `pages_page_id` IN ('103');";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Wijken - Straten' WHERE `pages_page_id` IN ('104');";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Buurt Informatie Netwerk' WHERE `pages_page_id` IN ('105');";
        $this->_queries .= "UPDATE `pages` SET `slug` = 'buurt-informatie-netwerk' WHERE `pages_page_id` IN ('105');";

        $this->_queries .= "UPDATE `categories` SET `title` = 'Buurt Informatie Netwerk' WHERE `table` IN ('bin');";
        $this->_queries .= "UPDATE `categories` SET `slug` = 'buurt-informatie-netwerk' WHERE `table` IN ('bin');";

        parent::up();

        // All the French speaking zones.
        $this->getZones()->reset()->where('language', '=', 2);

        $this->_queries = "UPDATE `pages` SET `title` = 'RIQ' WHERE `pages_page_id` IN ('102');";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Quartiers' WHERE `pages_page_id` IN ('103');";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Quartiers - Rues' WHERE `pages_page_id` IN ('104');";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Réseau d\'Information de Quartier' WHERE `pages_page_id` IN ('105');";
        $this->_queries .= "UPDATE `pages` SET `slug` = 'reseau-information-de-quartier' WHERE `pages_page_id` IN ('105');";

        $this->_queries .= "UPDATE `categories` SET `title` = 'Réseau d\'Information de Quartier' WHERE `table` IN ('bin');";
        $this->_queries .= "UPDATE `categories` SET `slug` = 'reseau-information-de-quartier' WHERE `table` IN ('bin');";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "DROP TABLE IF EXISTS `bin_relations`;";
        $this->_queries .= "DROP TABLE IF EXISTS `bin_districts`;";
        $this->_queries .= "DELETE FROM `extensions` WHERE `extensions_extension_id` IN ('46');";
        $this->_queries .= "DELETE FROM `pages` WHERE `pages_page_id` IN ('102', '103', '104', '105');";
        $this->_queries .= "DELETE FROM `categories` WHERE `table` IN ('bin');";

        parent::down();
    }
}
