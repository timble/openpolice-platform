<?php
use Phpmig\Migration\Migration;

class AddFrenchCityNames extends Migration
{
    public function up()
    {
        $this->getZones()->set(array('data' => 'Data'));

        $this->_queries = <<<EOL
ALTER TABLE `streets_cities` DROP PRIMARY KEY;
ALTER TABLE `streets_cities` CHANGE `streets_city_id` `streets_city_identifier` INT(11) NOT NULL;

ALTER TABLE `streets_cities` AUTO_INCREMENT = 1;
ALTER TABLE `streets_cities` ADD `streets_city_id` INT  NULL  DEFAULT NULL AUTO_INCREMENT  PRIMARY KEY FIRST;

ALTER TABLE `streets_cities` CHANGE `language` `iso` VARCHAR(2) NULL;
ALTER TABLE `streets_cities` ADD UNIQUE INDEX `streets_city_identifier` (`streets_city_identifier`, `iso`);

INSERT INTO `streets_cities` (`title`, `streets_city_identifier`, `iso`, `police_zone_id`, `crab_city_id`)
VALUES
    ('Anderlecht', '21001', 'fr', '5341', '71'),
    ('Auderghem', '21002', 'fr', '5342', '72'),
    ('Berchem-Sainte-Agathe', '21003', 'fr', '5340', '73'),
    ('Bruxelles', '21004', 'fr', '5339', '74'),
    ('Etterbeek', '21005', 'fr', '5343', '75'),
    ('Evere', '21006', 'fr', '5344', '76'),
    ('Forest', '21007', 'fr', '5341', '77'),
    ('Ganshoren', '21008', 'fr', '5340', '78'),
    ('Ixelles', '21009', 'fr', '5339', '79'),
    ('Jette', '21010', 'fr', '5340', '80'),
    ('Koekelberg', '21011', 'fr', '5340', '81'),
    ('Molenbeek-Saint-Jean', '21012', 'fr', '5340', '82'),
    ('Saint-Gilles', '21013', 'fr', '5341', '83'),
    ('Saint-Josse-ten-Noode', '21014', 'fr', '5344', '84'),
    ('Schaerbeek', '21015', 'fr', '5344', '85'),
    ('Uccle', '21016', 'fr', '5342', '86'),
    ('Watermael-Boitsfort', '21017', 'fr', '5342', '87'),
    ('Woluwe-Saint-Lambert', '21018', 'fr', '5343', '88'),
    ('Woluwe-Saint-Pierre', '21019', 'fr', '5343', '89');
EOL;

        parent::up();
    }

    public function down()
    {
        $this->getZones()->set(array('data' => 'Data'));

        $this->_queries = <<<EOL
DELETE FROM `streets_cities` WHERE `iso` = 'fr' AND `streets_city_identifier` >= 21001 AND `streets_city_identifier` <= 21019;

ALTER TABLE `streets_cities` DROP INDEX `streets_city_identifier`;
ALTER TABLE `streets_cities` CHANGE `iso` `language` VARCHAR(2)  CHARACTER SET utf8  NULL  DEFAULT NULL;
ALTER TABLE `streets_cities` DROP `streets_city_id`;
ALTER TABLE `streets_cities` CHANGE `streets_city_identifier` `streets_city_id` INT(11)  UNSIGNED  NOT NULL PRIMARY KEY;


EOL;

        parent::down();
    }
}
