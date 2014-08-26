<?php
use MyPhpmig\Police\Migration;

class CRABSupport extends Migration
{
    public function up()
    {
        $this->getZones()->set(array('data' => 'Data'));

        $this->_queries = <<<EOL
ALTER TABLE `streets_cities` ADD `crab_city_id` INT(11) NOT NULL DEFAULT 0 AFTER `police_zone_id`;

EOL;

        parent::up();
    }

    public function down()
    {
        $this->getZones()->set(array('data' => 'Data'));

        $this->_queries = <<<EOL
ALTER TABLE `streets_cities` DROP `crab_city_id`;

EOL;

        parent::down();
    }
}
