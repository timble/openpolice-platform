<?php

use MyPhpmig\Police\Migration;

class AddBinAutoIncrement extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "ALTER TABLE `bin_relations` DROP FOREIGN KEY `bin_relations__bin_district_id`;";
        $this->_queries .= "ALTER TABLE `bin_relations` DROP INDEX `bin_relations__bin_district_id`;";
        
        $this->_queries .= "ALTER TABLE `bin_relations` CHANGE `bin_district_id` `bin_district_id` INT(11)  NOT NULL;";
        $this->_queries .= "ALTER TABLE `bin_districts` CHANGE `bin_district_id` `bin_district_id` INT(11)  NOT NULL  AUTO_INCREMENT;";

        $this->_queries .= "ALTER TABLE `bin_relations` ADD CONSTRAINT `bin_relations__bin_district_id` FOREIGN KEY (`bin_district_id`) REFERENCES `bin_districts` (`bin_district_id`) ON DELETE CASCADE ON UPDATE CASCADE;";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "ALTER TABLE `bin_relations` DROP FOREIGN KEY `bin_relations__bin_district_id`;";
        $this->_queries .= "ALTER TABLE `bin_relations` DROP INDEX `bin_relations__bin_district_id`;";

        $this->_queries .= "ALTER TABLE `bin_districts` CHANGE `bin_district_id` `bin_district_id` VARCHAR(250)  CHARACTER SET utf8  NOT NULL  DEFAULT '';";
        $this->_queries .= "ALTER TABLE `bin_relations` CHANGE `bin_district_id` `bin_district_id` VARCHAR(250)  CHARACTER SET utf8  NOT NULL  DEFAULT '';";

        $this->_queries .= "ALTER TABLE `bin_relations` ADD CONSTRAINT `bin_relations__bin_district_id` FOREIGN KEY (`bin_district_id`) REFERENCES `bin_districts` (`bin_district_id`) ON DELETE CASCADE ON UPDATE CASCADE;";

        parent::down();
    }
}
