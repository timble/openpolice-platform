<?php

use MyPhpmig\Police\Migration;

class ExtendContactsHours extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "ALTER TABLE `contacts_hours` ADD `appointment` TINYINT(1)  NULL  DEFAULT NULL  AFTER `closing_time`;";
        $this->_queries .= "ALTER TABLE `contacts_hours` ADD `note` TEXT  NULL  AFTER `appointment`;";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "ALTER TABLE `contacts_hours` DROP `appointment`;";
        $this->_queries .= "ALTER TABLE `contacts_hours` DROP `note`;";

        parent::down();
    }
}
