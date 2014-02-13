<?php

use MyPhpmig\Police\Migration;

class AddContactsHours extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "CREATE TABLE `contacts_hours` (
                          `contacts_hour_id` int(11) NOT NULL AUTO_INCREMENT,
                          `contacts_contact_id` int(11) NOT NULL DEFAULT '0',
                          `day_of_week` tinyint(4) DEFAULT NULL,
                          `opening_time` time,
                          `closing_time` time,
                          `created_by` int(11) unsigned,
                          `created_on` datetime,
                          `modified_by` int(11) unsigned,
                          `modified_on` datetime,
                          `locked_by` int(11) unsigned,
                          `locked_on` datetime,
                          `params` text,
                          PRIMARY KEY (`contacts_hour_id`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        $this->_queries .= "INSERT INTO `pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
                            VALUES
                                (98, 2, 0, 'Hours', 'hours', 'option=com_contacts&view=hours', NULL, 'component', 1, 0, 0, 7, 1, '2014-02-13 11:14:14', NULL, NULL, NULL, NULL, 0, '');
                            ";
        $this->_queries .= "INSERT INTO `pages_closures` (`ancestor_id`, `descendant_id`, `level`)
                            VALUES
                                (14, 98, 1),
                                (4, 98, 2),
                                (98, 98, 0);";

        $this->_queries .= "INSERT INTO `pages_orderings` (`pages_page_id`, `title`, `custom`)
                            VALUES
                                (98, 00000000003, 00000000003);";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "DROP TABLE IF EXISTS `contacts_hours`;";
        $this->_queries .= "DELETE FROM `pages` WHERE `pages_page_id` IN ('98');";

        parent::down();
    }
}
