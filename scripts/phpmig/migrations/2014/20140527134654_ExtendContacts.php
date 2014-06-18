<?php

use MyPhpmig\Police\Migration;

class ExtendContacts extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "ALTER TABLE `contacts` CHANGE `name` `title` VARCHAR(255)  CHARACTER SET utf8  NOT NULL  DEFAULT '';";
        $this->_queries .= "ALTER TABLE `contacts` ADD `name` VARCHAR(255)  NULL  DEFAULT NULL  AFTER `slug`;";
        $this->_queries .= "ALTER TABLE `contacts` ADD `url` VARCHAR(255)  NULL  DEFAULT NULL  AFTER `email_to`;";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "ALTER TABLE `contacts` CHANGE `title` `name` VARCHAR(255)  CHARACTER SET utf8  NOT NULL  DEFAULT '';";
        $this->_queries .= "ALTER TABLE `contacts` DROP `name`;";
        $this->_queries .= "ALTER TABLE `contacts` DROP `url`;";

        parent::down();
    }
}
