<?php
use MyPhpmig\Police\Migration;

class RefactorStreetsDatabase extends Migration
{
    public function up()
    {
        $this->_queries = <<<EOL
CREATE TABLE `streets_relations` (
`streets_street_id` bigint(20) unsigned NOT NULL,
`row` bigint(20) unsigned NOT NULL,
`table` varchar(255) NOT NULL,
PRIMARY KEY (`streets_street_id`,`row`,`table`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Relations table for streets';


SET @value :=0;
UPDATE `districts_relations` SET `districts_relation_id` = (@value := @value + 1);
ALTER TABLE `districts_relations` CHANGE `districts_relation_id` `districts_relation_id` INT(11)  NOT NULL  AUTO_INCREMENT;
ALTER TABLE `districts_relations` AUTO_INCREMENT = 1;

SET @value :=0;
UPDATE `bin_relations` SET `bin_relation_id` = (@value := @value + 1);
ALTER TABLE `bin_relations` CHANGE `bin_relation_id` `bin_relation_id` INT(11)  NOT NULL  AUTO_INCREMENT;
ALTER TABLE `bin_relations` AUTO_INCREMENT = 1;


INSERT INTO `streets_relations` (`streets_street_id`, `row`)
SELECT `streets_street_id`, `bin_relation_id`
  FROM `bin_relations`
 WHERE `streets_street_id` != '';

UPDATE `streets_relations` SET `table` = 'bin_relations' WHERE `table` = '';

INSERT INTO `streets_relations` (`streets_street_id`, `row`)
SELECT `streets_street_id`, `contacts_contact_id`
  FROM `contacts`
 WHERE `streets_street_id` != '';

UPDATE `streets_relations` SET `table` = 'contacts' WHERE `table` = '';

INSERT INTO `streets_relations` (`streets_street_id`, `row`)
SELECT `streets_street_id`, `districts_relation_id`
  FROM `districts_relations`
 WHERE `streets_street_id` != '';

UPDATE `streets_relations` SET `table` = 'districts_relations' WHERE `table` = '';

INSERT INTO `streets_relations` (`streets_street_id`, `row`)
SELECT `streets_street_id`, `traffic_article_id`
  FROM `traffic_streets`;

UPDATE `streets_relations` SET `table` = 'traffic' WHERE `table` = '';


DROP TABLE IF EXISTS `traffic_streets`;

ALTER TABLE `bin_relations` DROP `streets_street_id`;
ALTER TABLE `districts_relations` DROP `streets_street_id`;
ALTER TABLE `contacts` DROP `streets_street_id`;
ALTER TABLE `bin_relations` DROP `islp`;
ALTER TABLE `districts_relations` DROP `islp`;
ALTER TABLE `contacts` DROP `suburb`;
ALTER TABLE `contacts` DROP `state`;
ALTER TABLE `contacts` DROP `address`;
ALTER TABLE `contacts` DROP `country`;
EOL;

        parent::up();
    }

    public function down()
    {
        $this->_queries = <<<EOL

CREATE TABLE `traffic_streets` (
  `streets_street_id` int(11) unsigned NOT NULL,
  `traffic_article_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`streets_street_id`,`traffic_article_id`),
  KEY `traffic_streets__traffic_article_id` (`traffic_article_id`),
  CONSTRAINT `traffic_streets__traffic_article_id` FOREIGN KEY (`traffic_article_id`) REFERENCES `traffic` (`traffic_article_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Relations table for streets';

INSERT INTO `traffic_streets` (`streets_street_id`, `traffic_article_id`)
SELECT `streets_street_id`, `row`
  FROM `streets_relations`
  WHERE `table` = 'traffic';

ALTER TABLE `districts_relations` ADD `streets_street_id` INT  NULL  DEFAULT NULL  AFTER `locked_on`;
ALTER TABLE `bin_relations` ADD `streets_street_id` INT  NULL  DEFAULT NULL  AFTER `locked_on`;
ALTER TABLE `contacts` ADD `streets_street_id` INT  NULL  DEFAULT NULL  AFTER `mobile`;

UPDATE `districts_relations` AS `a`, `streets_relations` AS `street`  SET `a`.`streets_street_id` = `street`.`streets_street_id` WHERE `a`.`districts_relation_id` = `street`.`row` AND `street`.`table` = 'districts_relations';
UPDATE `bin_relations` AS `a`, `streets_relations` AS `street`  SET `a`.`streets_street_id` = `street`.`streets_street_id` WHERE `a`.`bin_relation_id` = `street`.`row` AND `street`.`table` = 'bin_relations';
UPDATE `contacts` AS `a`, `streets_relations` AS `street`  SET `a`.`streets_street_id` = `street`.`streets_street_id` WHERE `a`.`contacts_contact_id` = `street`.`row` AND `street`.`table` = 'contacts';

DROP TABLE `streets_relations`;

EOL;

        parent::down();
    }
}
