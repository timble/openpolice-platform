<?php

use MyPhpmig\Police\Migration;

class AddEmailToDistricts extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "ALTER TABLE `districts` ADD `email` VARCHAR(250)  NULL  DEFAULT NULL  AFTER `slug`;";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "ALTER TABLE `districts` DROP `email`;";

        parent::down();
    }
}
