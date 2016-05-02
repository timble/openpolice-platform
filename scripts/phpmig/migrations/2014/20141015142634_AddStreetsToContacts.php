<?php

use MyPhpmig\Police\Migration;

class AddStreetsToContacts extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "ALTER TABLE `contacts` ADD `streets_street_id` INT(11)  NULL  DEFAULT NULL  AFTER `contacts_category_id`;";
        $this->_queries .= "ALTER TABLE `contacts` ADD `number` VARCHAR(100)  NULL  DEFAULT NULL  AFTER `position`;";

        parent::up();

        // All the multilingual zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "ALTER TABLE `fr-fr_contacts` ADD `streets_street_id` INT(11)  NULL  DEFAULT NULL  AFTER `contacts_category_id`;";
        $this->_queries .= "ALTER TABLE `fr-fr_contacts` ADD `number` VARCHAR(100)  NULL  DEFAULT NULL  AFTER `position`;";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "ALTER TABLE `contacts` DROP `streets_street_id`;";
        $this->_queries .= "ALTER TABLE `contacts` DROP `number`;";

        parent::down();

        // All the multilingual zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "ALTER TABLE `fr-fr_contacts` DROP `streets_street_id`;";
        $this->_queries .= "ALTER TABLE `fr-fr_contacts` DROP `number`;";

        parent::down();
    }
}
