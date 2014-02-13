<?php

use MyPhpmig\Police\Migration;

class AddContactsHoursTable extends Migration
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

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "DROP TABLE IF EXISTS `contacts_hours`;";

        parent::down();
    }
}
