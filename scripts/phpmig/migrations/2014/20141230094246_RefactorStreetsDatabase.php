<?php

use MyPhpmig\Police\Migration;

class RefactorStreetsDatabase extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "<<<EOL

CREATE TABLE `streets_relations` (
`streets_street_id` bigint(20) unsigned NOT NULL,
`row` bigint(20) unsigned NOT NULL,
`table` varchar(255) NOT NULL,
PRIMARY KEY (`streets_street_id`,`row`,`table`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Relations table for streets';


SET @value :=0; UPDATE `districts_relations` SET `districts_relation_id` = (@value := @value + 1);
ALTER TABLE `districts_relations` CHANGE `districts_relation_id` `districts_relation_id` INT(11)  NOT NULL  AUTO_INCREMENT;

SET @value :=0; UPDATE `bin_relations` SET `bin_relation_id` = (@value := @value + 1);
ALTER TABLE `bin_relations` CHANGE `bin_relation_id` `bin_relation_id` INT(11)  NOT NULL  AUTO_INCREMENT;


INSERT INTO `streets_relations` (`streets_street_id`, `row`)
SELECT `streets_street_id`, `bin_relation_id`
  FROM `bin_relations`
 WHERE `streets_street_id` != '';

UPDATE `streets_relations` SET `table` = 'bin_relations' WHERE `table` = '';

ALTER TABLE `bin_relations` DROP `streets_street_id`;
ALTER TABLE `bin_relations` DROP `islp`;
ALTER TABLE `bin_relations` AUTO_INCREMENT = 1;


INSERT INTO `streets_relations` (`streets_street_id`, `row`)
SELECT `streets_street_id`, `contacts_contact_id`
  FROM `contacts`
 WHERE `streets_street_id` != '';

UPDATE `streets_relations` SET `table` = 'contacts' WHERE `table` = '';

ALTER TABLE `contacts` DROP `streets_street_id`;
ALTER TABLE `contacts` DROP `suburb`;
ALTER TABLE `contacts` DROP `state`;
ALTER TABLE `contacts` DROP `address`;
ALTER TABLE `contacts` DROP `country`;


INSERT INTO `streets_relations` (`streets_street_id`, `row`)
SELECT `streets_street_id`, `districts_relation_id`
  FROM `districts_relations`
 WHERE `streets_street_id` != '';

UPDATE `streets_relations` SET `table` = 'districts_relations' WHERE `table` = '';

ALTER TABLE `districts_relations` DROP `streets_street_id`;
ALTER TABLE `districts_relations` DROP `islp`;
ALTER TABLE `districts_relations` AUTO_INCREMENT = 1;


INSERT INTO `streets_relations` (`streets_street_id`, `row`)
SELECT `streets_street_id`, `traffic_article_id`
  FROM `traffic_streets`;

UPDATE `streets_relations` SET `table` = 'traffic' WHERE `table` = '';

DROP TABLE `traffic_streets`;


EOL;";

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
