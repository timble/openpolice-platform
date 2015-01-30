<?php

use MyPhpmig\Police\Migration;

class AddNisToMunicipalities extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        // Target `data` database
        $this->getZones()->set(array('data' => 'Data'));

        $this->_queries = "ALTER TABLE `streets_municipalities` ADD `streets_city_id` INT  NULL  DEFAULT NULL  AFTER `streets_municipality_id`;";
        $this->_queries .= "UPDATE `streets_municipalities` AS `municipality`, `streets_postcodes` AS `postcode`
                            SET `municipality`.`streets_city_id` = `postcode`.`streets_city_id`
                            WHERE `municipality`.`postcode` = `postcode`.`streets_postcode_id`;";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        // Target `data` database
        $this->getZones()->set(array('data' => 'Data'));

        $this->_queries = "ALTER TABLE `streets_municipalities` DROP `streets_city_id`;";

        parent::down();
    }
}
