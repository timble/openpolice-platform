<?php

use MyPhpmig\Police\Migration;

class AddComPress extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "CREATE TABLE `press` (
                          `press_article_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                          `title` text NOT NULL,
                          `slug` varchar(250) DEFAULT NULL,
                          `text` mediumtext NOT NULL,
                          `published` tinyint(1) DEFAULT NULL,
                          `created_on` datetime DEFAULT NULL,
                          `created_by` int(11) unsigned NOT NULL DEFAULT '0',
                          `modified_on` datetime DEFAULT NULL,
                          `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
                          `locked_by` int(11) unsigned DEFAULT NULL,
                          `locked_on` datetime DEFAULT NULL,
                          `params` text,
                          PRIMARY KEY (`press_article_id`),
                          KEY `idx_state` (`published`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        $this->_queries .= "INSERT INTO `extensions` (`extensions_extension_id`, `title`, `name`, `params`, `enabled`) VALUES ('45', 'Press', 'com_press', '', '1');";
        $this->_queries .= "INSERT INTO `pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
                            VALUES
                                (100, 2, 0, 'Press', 'press', 'option=com_press&view=articles', NULL, 'component', 0, 0, 0, 45, 1, '2014-04-25 09:36:08', NULL, NULL, NULL, NULL, 0, ''),
                                (101, 1, 0, 'Press', 'press', 'option=com_press&view=articles', NULL, 'component', 0, 1, 0, 45, 1, '2014-04-25 09:51:10', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"');
                            ";

        $this->_queries .= "INSERT INTO `pages_closures` (`ancestor_id`, `descendant_id`, `level`)
                            VALUES
                                (4, 100, 1),
                                (100, 100, 0),
                                (101, 101, 0);
                            ";

        $this->_queries .= "INSERT INTO `pages_orderings` (`pages_page_id`, `title`, `custom`)
                            VALUES
                                (100, 00000000006, 00000000010),
                                (101, 00000000006, 00000000009);
                            ";

        parent::up();

        // All the Dutch and multilingual zones.
        $this->getZones()->where('language', '=', 1)->where('language', '=', 3, 'OR');

        $this->_queries = "UPDATE `pages` SET `title` = 'Pers' WHERE `pages_page_id` IN ('100', '101');";
        $this->_queries .= "UPDATE `pages` SET `slug` = 'pers' WHERE `pages_page_id` IN ('101');";

        parent::up();

        // All the French speaking zones.
        $this->getZones()->reset()->where('language', '=', 2);

        $this->_queries = "UPDATE `pages` SET `title` = 'Presse' WHERE `pages_page_id` IN ('100', '101');";
        $this->_queries .= "UPDATE `pages` SET `slug` = 'presse' WHERE `pages_page_id` IN ('101');";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "DROP TABLE IF EXISTS `press`;";
        $this->_queries .= "DELETE FROM `pages` WHERE `pages_page_id` IN ('100', '101');";
        $this->_queries .= "DELETE FROM `extensions` WHERE `extensions_extension_id` IN ('45');";

        parent::down();
    }
}
