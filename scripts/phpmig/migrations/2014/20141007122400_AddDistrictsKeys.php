<?php

use MyPhpmig\Police\Migration;

class AddDistrictsKeys extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "ALTER TABLE `districts_districts_officers` DROP FOREIGN KEY `districts_districts_officers__districts_district_id`;";
        $this->_queries .= "ALTER TABLE `districts_districts_officers` DROP FOREIGN KEY `districts_districts_officers__districts_officer_id`;";
        $this->_queries .= "ALTER TABLE `districts_districts_officers` DROP INDEX `districts_districts_officers__districts_officer_id`;";

        $this->_queries .= "ALTER TABLE `districts_relations` DROP FOREIGN KEY `districts_relations__districts_district_id`;";
        $this->_queries .= "ALTER TABLE `districts_relations` DROP INDEX `districts_relations__districts_district_id`;";

        $this->_queries .= "ALTER TABLE `districts` DROP PRIMARY KEY;";
        $this->_queries .= "ALTER TABLE `districts_officers` DROP PRIMARY KEY;";
        $this->_queries .= "ALTER TABLE `districts_districts_officers` DROP PRIMARY KEY;";

        $this->_queries .= "ALTER TABLE `districts_officers` ADD `islp` VARCHAR(250)  NULL  DEFAULT NULL AFTER `districts_officer_id`;";
        $this->_queries .= "UPDATE `districts_officers` SET `islp` = `districts_officer_id`;";
        $this->_queries .= "SET @value :=0; UPDATE districts_officers SET districts_officer_id = (@value := @value + 1);";

        $this->_queries .= "ALTER TABLE `districts` ADD `islp` VARCHAR(250)  NULL  DEFAULT NULL  AFTER `contacts_contact_id`;";
        $this->_queries .= "UPDATE `districts` SET `islp` = `districts_district_id`;";
        $this->_queries .= "ALTER TABLE `districts` ADD UNIQUE INDEX (`islp`);";
        $this->_queries .= "SET @value :=0; UPDATE districts SET districts_district_id = (@value := @value + 1);";

        $this->_queries .= "UPDATE `districts_relations` AS `relation`, `districts` AS `district` SET `relation`.`districts_district_id` = `district`.`districts_district_id` WHERE `relation`.`districts_district_id` = `district`.`islp`;";
        $this->_queries .= "UPDATE `districts_districts_officers` AS `relation`, `districts` AS `district` SET `relation`.`districts_district_id` = `district`.`districts_district_id` WHERE `relation`.`districts_district_id` = `district`.`islp`;";
        $this->_queries .= "UPDATE `districts_districts_officers` AS `relation`, `districts_officers` AS `officer` SET `relation`.`districts_officer_id` = `officer`.`districts_officer_id` WHERE `relation`.`districts_officer_id` = `officer`.`islp`;";

        $this->_queries .= "ALTER TABLE `districts_districts_officers` CHANGE `districts_district_id` `districts_district_id` INT(11)  NOT NULL;";

        $this->_queries .= "ALTER TABLE `districts` ADD PRIMARY KEY (`districts_district_id`);";
        $this->_queries .= "ALTER TABLE `districts_officers` ADD PRIMARY KEY (`districts_officer_id`);";
        $this->_queries .= "ALTER TABLE `districts_districts_officers` ADD PRIMARY KEY (`districts_district_id`, `districts_officer_id`);";

        $this->_queries .= "ALTER TABLE `districts` CHANGE `districts_district_id` `districts_district_id` INT(11)  NOT NULL  AUTO_INCREMENT;";
        $this->_queries .= "ALTER TABLE `districts_officers` CHANGE `districts_officer_id` `districts_officer_id` INT(11)  UNSIGNED  NOT NULL  AUTO_INCREMENT;";
        $this->_queries .= "ALTER TABLE `districts_relations` CHANGE `districts_district_id` `districts_district_id` INT(11)  NOT NULL;";

        $this->_queries .= "ALTER TABLE `districts_relations` ADD CONSTRAINT `districts_relations__districts_district_id` FOREIGN KEY (`districts_district_id`) REFERENCES `districts` (`districts_district_id`) ON DELETE CASCADE ON UPDATE CASCADE;";

        $this->_queries .= "ALTER TABLE `districts_districts_officers` ADD CONSTRAINT `districts_districts_officers__districts_district_id` FOREIGN KEY (`districts_district_id`) REFERENCES `districts` (`districts_district_id`) ON DELETE CASCADE ON UPDATE CASCADE;";
        $this->_queries .= "ALTER TABLE `districts_districts_officers` ADD CONSTRAINT `districts_districts_officers__districts_officer_id` FOREIGN KEY (`districts_officer_id`) REFERENCES `districts_officers` (`districts_officer_id`) ON DELETE CASCADE ON UPDATE CASCADE;";

        $this->_queries .= "UPDATE `attachments_relations` AS `relation`, `districts_officers` AS `officer` SET `relation`.`row` = `officer`.`districts_officer_id` WHERE `relation`.`row` = `officer`.`islp` AND `relation`.`table` = 'districts_officers';";
        $this->_queries .= "UPDATE `activities` AS `activity`, `districts_officers` AS `officer` SET `activity`.`row` = `officer`.`districts_officer_id` WHERE `activity`.`row` = `officer`.`islp` AND `activity`.`name` = 'officer';";
        $this->_queries .= "UPDATE `activities` AS `activity`, `districts` AS `district` SET `activity`.`row` = `district`.`districts_district_id` WHERE `activity`.`row` = `district`.`islp` AND `activity`.`name` = 'district';";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "UPDATE `attachments_relations` AS `relation`, `districts_officers` AS `officer` SET `relation`.`row` = `officer`.`islp` WHERE `relation`.`row` = `officer`.`districts_officer_id` AND `relation`.`table` = 'districts_officers';";
        $this->_queries .= "UPDATE `activities` AS `activity`, `districts_officers` AS `officer` SET `activity`.`row` = `officer`.`islp` WHERE `activity`.`row` = `officer`.`districts_officer_id` AND `activity`.`name` = 'officer';";
        $this->_queries .= "UPDATE `activities` AS `activity`, `districts` AS `district` SET `activity`.`row` = `district`.`islp` WHERE `activity`.`row` = `district`.`districts_district_id` AND `activity`.`name` = 'district';";

        $this->_queries .= "ALTER TABLE `districts_districts_officers` DROP FOREIGN KEY `districts_districts_officers__districts_district_id`;";
        $this->_queries .= "ALTER TABLE `districts_districts_officers` DROP FOREIGN KEY `districts_districts_officers__districts_officer_id`;";
        $this->_queries .= "ALTER TABLE `districts_districts_officers` DROP INDEX `districts_districts_officers__districts_officer_id`;";

        $this->_queries .= "ALTER TABLE `districts_relations` DROP FOREIGN KEY `districts_relations__districts_district_id`;";
        $this->_queries .= "ALTER TABLE `districts_relations` DROP INDEX `districts_relations__districts_district_id`;";

        $this->_queries .= "ALTER TABLE `districts_districts_officers` CHANGE `districts_district_id` `districts_district_id` VARCHAR(250)  NOT NULL;";
        $this->_queries .= "ALTER TABLE `districts_relations` CHANGE `districts_district_id` `districts_district_id` VARCHAR(250)  NOT NULL;";
        $this->_queries .= "ALTER TABLE `districts_officers` CHANGE `districts_officer_id` `districts_officer_id` INT(11)  UNSIGNED  NOT NULL;";
        $this->_queries .= "ALTER TABLE `districts` CHANGE `districts_district_id` `districts_district_id` VARCHAR(250)  NOT NULL;";

        $this->_queries .= "ALTER TABLE `districts` DROP PRIMARY KEY;";
        $this->_queries .= "ALTER TABLE `districts_officers` DROP PRIMARY KEY;";
        $this->_queries .= "ALTER TABLE `districts_districts_officers` DROP PRIMARY KEY;";

        $this->_queries .= "UPDATE `districts_districts_officers` AS `relation`, `districts` AS `district` SET `relation`.`districts_district_id` = `district`.`islp` WHERE `relation`.`districts_district_id` = `district`.`districts_district_id`;";
        $this->_queries .= "UPDATE `districts_districts_officers` AS `relation`, `districts_officers` AS `officer` SET `relation`.`districts_officer_id` = `officer`.`islp` WHERE `relation`.`districts_officer_id` = `officer`.`districts_officer_id`;";

        $this->_queries .= "UPDATE `districts_relations` AS `relation`, `districts` AS `district` SET `relation`.`districts_district_id` = `district`.`islp` WHERE `relation`.`districts_district_id` = `district`.`districts_district_id`;";

        $this->_queries .= "UPDATE `districts_officers` SET `districts_officer_id` = `islp`;";
        $this->_queries .= "ALTER TABLE `districts_officers` DROP `islp`;";

        $this->_queries .= "UPDATE `districts` SET `districts_district_id` = `islp`;";
        $this->_queries .= "ALTER TABLE `districts` DROP `islp`;";

        $this->_queries .= "ALTER TABLE `districts` ADD PRIMARY KEY (`districts_district_id`);";
        $this->_queries .= "ALTER TABLE `districts_officers` ADD PRIMARY KEY (`districts_officer_id`);";
        $this->_queries .= "ALTER TABLE `districts_districts_officers` ADD PRIMARY KEY (`districts_district_id`, `districts_officer_id`);";

        $this->_queries .= "ALTER TABLE `districts_districts_officers` ADD CONSTRAINT `districts_districts_officers__districts_officer_id` FOREIGN KEY (`districts_officer_id`) REFERENCES `districts_officers` (`districts_officer_id`) ON DELETE CASCADE ON UPDATE CASCADE;";
        $this->_queries .= "ALTER TABLE `districts_districts_officers` ADD CONSTRAINT `districts_districts_officers__districts_district_id` FOREIGN KEY (`districts_district_id`) REFERENCES `districts` (`districts_district_id`) ON DELETE CASCADE ON UPDATE CASCADE;";

        $this->_queries .= "ALTER TABLE `districts_relations` ADD CONSTRAINT `districts_relations__districts_district_id` FOREIGN KEY (`districts_district_id`) REFERENCES `districts` (`districts_district_id`) ON DELETE CASCADE ON UPDATE CASCADE;";

        parent::down();
    }
}
