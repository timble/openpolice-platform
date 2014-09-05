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
        $this->_queries .= "UPDATE `news` SET `publish_on` = `created_on`;";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "ALTER TABLE `news` CHANGE `published` `published` tinyint(1) DEFAULT NULL";

        parent::down();
    }
}
