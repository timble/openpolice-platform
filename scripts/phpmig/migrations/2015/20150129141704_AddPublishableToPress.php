<?php

use MyPhpmig\Police\Migration;

class AddPublishableToPress extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "ALTER TABLE `press` CHANGE `published` `published` TINYINT(1) NOT NULL DEFAULT '0';";
        $this->_queries .= "ALTER TABLE `press` ADD `published_on` DATETIME  NULL  DEFAULT NULL  AFTER `published`;";
        $this->_queries .= "ALTER TABLE `press` ADD `publish_on` DATETIME  NULL  DEFAULT NULL  AFTER `locked_on`;";
        $this->_queries .= "UPDATE `press` SET `published_on` = `created_on`;";
        $this->_queries .= "UPDATE `press` SET `publish_on` = NULL;";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "ALTER TABLE `press` DROP `publish_on`;";
        $this->_queries .= "ALTER TABLE `press` DROP `published_on`;";

        parent::down();
    }
}
