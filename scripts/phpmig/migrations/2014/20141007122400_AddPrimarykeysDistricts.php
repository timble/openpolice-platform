<?php

use MyPhpmig\Police\Migration;

class AddPrimarykeysDistricts extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "ALTER TABLE `districts_officers` ADD `temp` VARCHAR(250)  NULL  DEFAULT NULL;";
        $this->_queries .= "UPDATE `districts_officers` SET `temp` = `districts_officer_id`;";
        $this->_queries .= "SET @value :=0; UPDATE districts_officers SET districts_officer_id = (@value := @value + 1);";
        $this->_queries .= "ALTER TABLE `districts_officers` CHANGE `districts_officer_id` `districts_officer_id` INT(11)  UNSIGNED  NOT NULL  AUTO_INCREMENT;";
        $this->_queries .= "ALTER TABLE `districts_officers` DROP `old_id`;";
        $this->_queries .= "ALTER TABLE `districts_officers` DROP `show_image`;";
        $this->_queries .= "ALTER TABLE `districts_officers` DROP `params`;";
        $this->_queries .= "ALTER TABLE `districts_officers` DROP `position`;";

        $this->_queries .= "ALTER TABLE `districts` ADD `islp` VARCHAR(250)  NULL  DEFAULT NULL  AFTER `contacts_contact_id`;";
        $this->_queries .= "ALTER TABLE `districts` ADD UNIQUE INDEX (`islp`);";
        $this->_queries .= "UPDATE `districts` SET `islp` = `districts_district_id`;";
        $this->_queries .= "SET @value :=0; UPDATE districts SET districts_district_id = (@value := @value + 1);";

        $this->_queries .= "ALTER TABLE `districts_districts_officers` DROP FOREIGN KEY `districts_districts_officers__districts_district_id`;";
        $this->_queries .= "ALTER TABLE `districts_districts_officers` DROP PRIMARY KEY;";
        $this->_queries .= "ALTER TABLE `districts_districts_officers` CHANGE `districts_district_id` `districts_district_id` INT(11)  NOT NULL;";

        $this->_queries .= "ALTER TABLE `districts_relations` DROP FOREIGN KEY `districts_relations__districts_district_id`;";
        $this->_queries .= "ALTER TABLE `districts_relations` DROP INDEX `districts_relations__districts_district_id`;";
        $this->_queries .= "ALTER TABLE `districts_relations` CHANGE `districts_district_id` `districts_district_id` INT(11)  NOT NULL;";

        $this->_queries .= "ALTER TABLE `districts` CHANGE `districts_district_id` `districts_district_id` INT(11)  NOT NULL  AUTO_INCREMENT;";

        $this->_queries .= "ALTER TABLE `districts_relations` ADD CONSTRAINT `districts_relations__districts_district_id` FOREIGN KEY (`districts_district_id`) REFERENCES `districts` (`districts_district_id`) ON DELETE CASCADE ON UPDATE CASCADE;";

        $this->_queries .= "ALTER TABLE `districts_districts_officers` ADD PRIMARY KEY (`districts_district_id`, `districts_officer_id`);";
        $this->_queries .= "ALTER TABLE `districts_districts_officers` ADD CONSTRAINT `districts_districts_officers__districts_district_id` FOREIGN KEY (`districts_district_id`) REFERENCES `districts` (`districts_district_id`) ON DELETE CASCADE ON UPDATE CASCADE;";

        $this->_queries .= "UPDATE `attachments_relations` AS `relation`, `districts_officers` AS `officer` SET `relation`.`row` = `officer`.`districts_officer_id` WHERE `relation`.`row` = `officer`.`temp` AND `relation`.`table` = 'districts_officers';";
        $this->_queries .= "UPDATE `activities` AS `activity`, `districts_officers` AS `officer` SET `activity`.`row` = `officer`.`districts_officer_id` WHERE `activity`.`row` = `officer`.`temp` AND `activity`.`name` = 'officer';";
        $this->_queries .= "UPDATE `activities` AS `activity`, `districts` AS `district` SET `activity`.`row` = `district`.`districts_district_id` WHERE `activity`.`row` = `district`.`islp` AND `activity`.`name` = 'district';";

        // If the temp column is removed all queries were executed
        $this->_queries .= "ALTER TABLE `districts_officers` DROP `temp`;";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        parent::down();
    }
}
