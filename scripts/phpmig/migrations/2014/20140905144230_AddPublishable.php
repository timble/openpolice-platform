<?php

use MyPhpmig\Police\Migration;

class AddPublishable extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "ALTER TABLE `news` CHANGE `published` `published` TINYINT(1) NOT NULL DEFAULT '0';";
        $this->_queries .= "ALTER TABLE `news` ADD `published_on` DATETIME  NULL  DEFAULT NULL  AFTER `published`;";
        $this->_queries .= "UPDATE `news` SET `published_on` = `created_on`;";
        $this->_queries .= "UPDATE `news` SET `publish_on` = NULL;";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "ALTER TABLE `news` CHANGE `published` `published` tinyint(1) DEFAULT NULL";
        $this->_queries .= "ALTER TABLE `news` DROP `published_on`;";

        parent::down();
    }
}
