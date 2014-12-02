<?php

use MyPhpmig\Police\Migration;

class CleanupDistrictsOfficers extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "ALTER TABLE `districts_officers` DROP `islp`;";
        $this->_queries .= "ALTER TABLE `districts_officers` DROP `position`;";
        $this->_queries .= "ALTER TABLE `districts_officers` DROP `show_image`;";
        $this->_queries .= "ALTER TABLE `districts_officers` DROP `old_id`;";
        $this->_queries .= "UPDATE `districts_officers` SET `params` = '';";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "ALTER TABLE `districts_officers` ADD `islp` VARCHAR(250)  NULL  DEFAULT NULL  AFTER `params`;";
        $this->_queries .= "ALTER TABLE `districts_officers` ADD `position` VARCHAR(250)  NULL  DEFAULT NULL  AFTER `params`;";
        $this->_queries .= "ALTER TABLE `districts_officers` ADD `show_image` VARCHAR(250)  NULL  DEFAULT NULL  AFTER `params`;";
        $this->_queries .= "ALTER TABLE `districts_officers` ADD `old_id` VARCHAR(250)  NULL  DEFAULT NULL  AFTER `params`;";

        parent::down();
    }
}
