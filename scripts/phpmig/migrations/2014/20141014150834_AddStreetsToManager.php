<?php

use MyPhpmig\Police\Migration;

class AddStreetsToManager extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->getZones()->set(array('manager' => 'Manager'));

        $this->_queries = "INSERT INTO `extensions` (`extensions_extension_id`, `title`, `name`, `params`, `enabled`)
                            VALUES
                                (5, 'Streets', 'com_streets', '', 1);
                            ";

        $this->_queries .= "INSERT INTO `pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
                            VALUES
                                (4, 1, 0, 'Streets', 'streets', 'option=com_streets&view=streets', NULL, 'component', 1, 0, 0, 5, 1, now(), NULL, NULL, NULL, NULL, 0, NULL),
                                (5, 1, 0, 'Streets', 'streets', 'option=com_streets&view=streets', NULL, 'component', 1, 0, 0, 5, 1, now(), NULL, NULL, NULL, NULL, 0, NULL),
                                (6, 1, 0, 'Cities', 'cities', 'option=com_streets&view=cities', NULL, 'component', 1, 0, 0, 5, 1, now(), NULL, NULL, NULL, NULL, 0, NULL),
                                (7, 1, 0, 'Postcodes', 'postcodes', 'option=com_streets&view=postcodes', NULL, 'component', 1, 0, 0, 5, 1, now(), NULL, NULL, NULL, NULL, 0, NULL),
                                (8, 1, 0, 'Municipalities', 'municipalities', 'option=com_streets&view=municipalities', NULL, 'component', 1, 0, 0, 5, 1, now(), NULL, NULL, NULL, NULL, 0, NULL);
                                (9, 1, 0, 'Logs', 'logs', 'option=com_streets&view=logs', NULL, 'component', 1, 0, 0, 5, 1, now(), NULL, NULL, NULL, NULL, 0, NULL),
                            ";

        $this->_queries .= "INSERT INTO `pages_closures` (`ancestor_id`, `descendant_id`, `level`)
                            VALUES
                                (4, 4, 0),
                                (5, 5, 0),
                                (6, 6, 0),
                                (7, 7, 0),
                                (8, 8, 0),
                                (9, 9, 0),
                                (4, 5, 1),
                                (4, 6, 1),
                                (4, 7, 1),
                                (4, 8, 1),
                                (4, 9, 1);
                            ";

        $this->_queries .= "INSERT INTO `pages_orderings` (`pages_page_id`, `title`, `custom`)
                            VALUES
                                (4, 00000000004, 00000000004),
                                (5, 00000000001, 00000000001),
                                (6, 00000000002, 00000000002),
                                (7, 00000000003, 00000000003),
                                (8, 00000000004, 00000000004),
                                (9, 00000000005, 00000000005);
                            ";

        parent::up();

        $this->getZones()->set(array('data' => 'Data'));

        $this->_queries = "RENAME TABLE `police_municipalities` TO `streets_municipalities`;";
        $this->_queries .= "ALTER TABLE `streets_municipalities` CHANGE `police_municipality_id` `streets_municipality_id` INT(20)  NOT NULL  AUTO_INCREMENT;";

        $this->_queries .= "ALTER TABLE `streets_cities` ADD `created_by` INT(11)  NULL  DEFAULT NULL  AFTER `crab_city_id`;";
        $this->_queries .= "ALTER TABLE `streets_cities` ADD `created_on` DATETIME  NULL  AFTER `created_by`;";
        $this->_queries .= "ALTER TABLE `streets_cities` ADD `modified_by` INT(11)  NULL  DEFAULT NULL  AFTER `created_on`;";
        $this->_queries .= "ALTER TABLE `streets_cities` ADD `modified_on` DATETIME  NULL  AFTER `modified_by`;";
        $this->_queries .= "ALTER TABLE `streets_cities` ADD `locked_by` INT(11)  NULL  DEFAULT NULL  AFTER `modified_on`;";
        $this->_queries .= "ALTER TABLE `streets_cities` ADD `locked_on` DATETIME  NULL  AFTER `locked_by`;";

        $this->_queries .= "ALTER TABLE `streets_postcodes` ADD `created_by` INT(11)  NULL  DEFAULT NULL  AFTER `fgem`;";
        $this->_queries .= "ALTER TABLE `streets_postcodes` ADD `created_on` DATETIME  NULL  AFTER `created_by`;";
        $this->_queries .= "ALTER TABLE `streets_postcodes` ADD `modified_by` INT(11)  NULL  DEFAULT NULL  AFTER `created_on`;";
        $this->_queries .= "ALTER TABLE `streets_postcodes` ADD `modified_on` DATETIME  NULL  AFTER `modified_by`;";
        $this->_queries .= "ALTER TABLE `streets_postcodes` ADD `locked_by` INT(11)  NULL  DEFAULT NULL  AFTER `modified_on`;";
        $this->_queries .= "ALTER TABLE `streets_postcodes` ADD `locked_on` DATETIME  NULL  AFTER `locked_by`;";

        $this->_queries .= "ALTER TABLE `streets_municipalities` DROP `police_zone_id`;";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->getZones()->set(array('manager' => 'Manager'));

        $this->_queries = "DELETE FROM `extensions` WHERE `extensions_extension_id` IN ('5');";
        $this->_queries .= "DELETE FROM `pages` WHERE `pages_page_id` IN ('4', '5', '6', '7', '8', '9');";

        parent::down();

        $this->getZones()->set(array('data' => 'Data'));

        $this->_queries = "RENAME TABLE `streets_municipalities` TO `police_municipalities`;";
        $this->_queries .= "ALTER TABLE `police_municipalities` CHANGE `streets_municipality_id` `police_municipality_id` INT(20)  NOT NULL  AUTO_INCREMENT;";


        parent::down();
    }
}
