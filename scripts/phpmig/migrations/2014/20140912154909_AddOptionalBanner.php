<?php

use MyPhpmig\Police\Migration;

class AddOptionalBanner extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->getZones()->set(array('data' => 'Data'));

        $this->_queries = "ALTER TABLE `police_zones` ADD `banner` TINYINT(1)  NULL  DEFAULT NULL  AFTER `facebook`;";
        $this->_queries .= "UPDATE `police_zones` SET `banner` = '1' WHERE `police_zone_id` IN ('5283', '5288', '5317', '5318', '5370', '5372', '5388', '5396', '5421', '5430', '5443', '5446', '5888');";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->getZones()->set(array('data' => 'Data'));

        $this->_queries = "ALTER TABLE `police_zones` DROP `banner`;";

        parent::down();
    }
}
