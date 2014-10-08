<?php

use MyPhpmig\Police\Migration;

class AddDistrictsKeys extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = <<<EOL
ALTER TABLE `districts_officers` ADD `temp` VARCHAR(250)  NULL  DEFAULT NULL;
UPDATE `districts_officers` SET `temp` = `districts_officer_id`;
SET @value :=0; UPDATE districts_officers SET districts_officer_id = (@value := @value + 1);
ALTER TABLE `districts_officers` CHANGE `districts_officer_id` `districts_officer_id` INT(11)  UNSIGNED  NOT NULL  AUTO_INCREMENT;
ALTER TABLE `districts_officers` DROP `old_id`;
ALTER TABLE `districts_officers` DROP `show_image`;
ALTER TABLE `districts_officers` DROP `params`;
ALTER TABLE `districts_officers` DROP `position`;

ALTER TABLE `districts` ADD `islp` VARCHAR(250)  NULL  DEFAULT NULL  AFTER `contacts_contact_id`;
UPDATE `districts` SET `islp` = `districts_district_id`;
ALTER TABLE `districts` ADD UNIQUE INDEX (`islp`);
SET @value :=0; UPDATE districts SET districts_district_id = (@value := @value + 1);

ALTER TABLE `districts_districts_officers` DROP FOREIGN KEY `districts_districts_officers__districts_district_id`;
ALTER TABLE `districts_districts_officers` DROP PRIMARY KEY;
ALTER TABLE `districts_districts_officers` CHANGE `districts_district_id` `districts_district_id` INT(11)  NOT NULL;

ALTER TABLE `districts_relations` DROP FOREIGN KEY `districts_relations__districts_district_id`;
ALTER TABLE `districts_relations` DROP INDEX `districts_relations__districts_district_id`;
ALTER TABLE `districts_relations` CHANGE `districts_district_id` `districts_district_id` INT(11)  NOT NULL;

ALTER TABLE `districts` CHANGE `districts_district_id` `districts_district_id` INT(11)  NOT NULL  AUTO_INCREMENT;

ALTER TABLE `districts_relations` ADD CONSTRAINT `districts_relations__districts_district_id` FOREIGN KEY (`districts_district_id`) REFERENCES `districts` (`districts_district_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `districts_districts_officers` ADD PRIMARY KEY (`districts_district_id`, `districts_officer_id`);
ALTER TABLE `districts_districts_officers` ADD CONSTRAINT `districts_districts_officers__districts_district_id` FOREIGN KEY (`districts_district_id`) REFERENCES `districts` (`districts_district_id`) ON DELETE CASCADE ON UPDATE CASCADE;

UPDATE `attachments_relations` AS `relation`, `districts_officers` AS `officer` SET `relation`.`row` = `officer`.`districts_officer_id` WHERE `relation`.`row` = `officer`.`temp` AND `relation`.`table` = 'districts_officers';
UPDATE `activities` AS `activity`, `districts_officers` AS `officer` SET `activity`.`row` = `officer`.`districts_officer_id` WHERE `activity`.`row` = `officer`.`temp` AND `activity`.`name` = 'officer';
UPDATE `activities` AS `activity`, `districts` AS `district` SET `activity`.`row` = `district`.`districts_district_id` WHERE `activity`.`row` = `district`.`islp` AND `activity`.`name` = 'district';
EOL;

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = <<<EOL
UPDATE `attachments_relations` AS `relation`, `districts_officers` AS `officer` SET `relation`.`row` = `officer`.`temp` WHERE `relation`.`row` = `officer`.`districts_officer_id` AND `relation`.`table` = 'districts_officers';
UPDATE `activities` AS `activity`, `districts_officers` AS `officer` SET `activity`.`row` = `officer`.`temp` WHERE `activity`.`row` = `officer`.`districts_officer_id` AND `activity`.`name` = 'officer';
UPDATE `activities` AS `activity`, `districts` AS `district` SET `activity`.`row` = `district`.`islp` WHERE `activity`.`row` = `district`.`districts_district_id` AND `activity`.`name` = 'district';

ALTER TABLE `districts_officers` ADD `old_id` VARCHAR(250)  NULL  DEFAULT NULL;
ALTER TABLE `districts_officers` ADD `show_image` VARCHAR(250)  NULL  DEFAULT NULL;
ALTER TABLE `districts_officers` ADD `params` VARCHAR(250)  NULL  DEFAULT NULL;
ALTER TABLE `districts_officers` ADD `position` VARCHAR(250)  NULL  DEFAULT NULL;

ALTER TABLE `districts_districts_officers` DROP FOREIGN KEY `districts_districts_officers__districts_district_id`;
ALTER TABLE `districts_districts_officers` DROP PRIMARY KEY;
ALTER TABLE `districts_districts_officers` CHANGE `districts_district_id` `districts_district_id` VARCHAR(250)  NOT NULL;

ALTER TABLE `districts_relations` DROP FOREIGN KEY `districts_relations__districts_district_id`;
ALTER TABLE `districts_relations` DROP INDEX `districts_relations__districts_district_id`;
ALTER TABLE `districts_relations` CHANGE `districts_district_id` `districts_district_id` VARCHAR(250)  NOT NULL;

UPDATE `districts_districts_officers` AS `relation`, `districts` AS `district` SET `relation`.`districts_district_id` = `district`.`islp` WHERE `relation`.`districts_district_id` = `district`.`districts_district_id`;
UPDATE `districts_relations` AS `relation`, `districts` AS `district` SET `relation`.`districts_district_id` = `district`.`islp` WHERE `relation`.`districts_district_id` = `district`.`districts_district_id`;

ALTER TABLE `districts_officers` CHANGE `districts_officer_id` `districts_officer_id` INT(11)  UNSIGNED  NOT NULL;
UPDATE `districts_officers` SET `districts_officer_id` = `temp`;
ALTER TABLE `districts_officers` DROP `temp`;

ALTER TABLE `districts` CHANGE `districts_district_id` `districts_district_id` VARCHAR(250)  NOT NULL;
UPDATE `districts` SET `districts_district_id` = `islp`;
ALTER TABLE `districts` DROP `islp`;

ALTER TABLE `districts_relations` ADD CONSTRAINT `districts_relations__districts_district_id` FOREIGN KEY (`districts_district_id`) REFERENCES `districts` (`districts_district_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `districts_districts_officers` ADD PRIMARY KEY (`districts_district_id`, `districts_officer_id`);
ALTER TABLE `districts_districts_officers` ADD CONSTRAINT `districts_districts_officers__districts_district_id` FOREIGN KEY (`districts_district_id`) REFERENCES `districts` (`districts_district_id`) ON DELETE CASCADE ON UPDATE CASCADE;
EOL;

        parent::down();
    }
}
