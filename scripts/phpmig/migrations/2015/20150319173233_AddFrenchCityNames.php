<?php

use MyPhpmig\Police\Migration;

class AddFrenchCityNames extends Migration
{
    public function up()
    {
        $this->getZones()->set(array('data' => 'Data'));

        $this->_queries = <<<EOL
ALTER TABLE `streets_cities` DROP `language`;

CREATE TABLE `fr-be_streets_cities` LIKE `streets_cities`;
INSERT `fr-be_streets_cities` SELECT * FROM `streets_cities`;

UPDATE `fr-be_streets_cities` SET `title` = 'Anderlecht' WHERE `streets_city_id` = 21001;
UPDATE `fr-be_streets_cities` SET `title` = 'Auderghem' WHERE `streets_city_id` = 21002;
UPDATE `fr-be_streets_cities` SET `title` = 'Berchem-Sainte-Agathe' WHERE `streets_city_id` = 21003;
UPDATE `fr-be_streets_cities` SET `title` = 'Bruxelles' WHERE `streets_city_id` = 21004;
UPDATE `fr-be_streets_cities` SET `title` = 'Etterbeek' WHERE `streets_city_id` = 21005;
UPDATE `fr-be_streets_cities` SET `title` = 'Evere' WHERE `streets_city_id` = 21006;
UPDATE `fr-be_streets_cities` SET `title` = 'Forest' WHERE `streets_city_id` = 21007;
UPDATE `fr-be_streets_cities` SET `title` = 'Ganshoren' WHERE `streets_city_id` = 21008;
UPDATE `fr-be_streets_cities` SET `title` = 'Ixelles' WHERE `streets_city_id` = 21009;
UPDATE `fr-be_streets_cities` SET `title` = 'Jette' WHERE `streets_city_id` = 21010;
UPDATE `fr-be_streets_cities` SET `title` = 'Koekelberg' WHERE `streets_city_id` = 21011;
UPDATE `fr-be_streets_cities` SET `title` = 'Molenbeek-Saint-Jean' WHERE `streets_city_id` = 21012;
UPDATE `fr-be_streets_cities` SET `title` = 'Saint-Gilles' WHERE `streets_city_id` = 21013;
UPDATE `fr-be_streets_cities` SET `title` = 'Saint-Josse-ten-Noode' WHERE `streets_city_id` = 21014;
UPDATE `fr-be_streets_cities` SET `title` = 'Schaerbeek' WHERE `streets_city_id` = 21015;
UPDATE `fr-be_streets_cities` SET `title` = 'Uccle' WHERE `streets_city_id` = 21016;
UPDATE `fr-be_streets_cities` SET `title` = 'Watermael-Boitsfort' WHERE `streets_city_id` = 21017;
UPDATE `fr-be_streets_cities` SET `title` = 'Woluwe-Saint-Lambert' WHERE `streets_city_id` = 21018;
UPDATE `fr-be_streets_cities` SET `title` = 'Woluwe-Saint-Pierre' WHERE `streets_city_id` = 21019;
EOL;

        parent::up();
    }

    public function down()
    {
        $this->getZones()->set(array('data' => 'Data'));

        $this->_queries = <<<EOL
DROP TABLE `fr-be_streets_cities`;

ALTER TABLE `streets_cities` ADD `language` varchar(2) DEFAULT NULL AFTER `title`;
EOL;

        parent::down();
    }
}
