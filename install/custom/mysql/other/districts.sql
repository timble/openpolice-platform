-- Delete NON Leuven streets
DELETE FROM `streets`
WHERE `postcode` NOT IN ('3000', '3001', '3010', '3012', '3018');

-- Delete FR streets
DELETE FROM `streets`
WHERE `language` != 'N';

-- Update codes to row IDs (ISLP import)
DELETE relation FROM `districts_relations` AS `relation`, `districts_relations` AS `b`
WHERE `relation`.`streets_street_code` = `b`.`streets_street_code`
AND relation.districts_relation_id > b.districts_relation_id;


-- Update codes to row IDs (ISLP import)
UPDATE `districts_relations` AS `relation`, `streets` AS `street`
SET `relation`.`streets_street_id` = `street`.`streets_street_id`
WHERE `relation`.`streets_street_code` = `street`.`streets_street_code`;

UPDATE `districts_relations` AS `relation`, `districts` AS `district`
SET `relation`.`districts_district_id` = `district`.`districts_district_id`
WHERE `relation`.`districts_district_code` = `district`.`districts_district_code`;


-- Update districts_officers
UPDATE `districts_officers` AS `district_officer`, `districts` AS `district`
SET `district_officer`.`districts_district_id` = `district`.`districts_district_id`
WHERE `district_officer`.`districts_district_code` = `district`.`districts_district_code`;

UPDATE `districts_officers` AS `district_officer`, `districts_officers` AS `officer`
SET `district_officer`.`districts_officer_id` = `officer`.`districts_officer_id`
WHERE `district_officer`.`districts_officer_code` = `officer`.`districts_officer_code`;


-- Update Parity after (ISLP import)
UPDATE `districts_relations`
SET `range_parity` = 'odd'
WHERE `range_parity` = '1';

UPDATE `districts_relations`
SET `range_parity` = 'even'
WHERE `range_parity` = '2';

UPDATE `districts_relations`
SET `range_parity` = 'odd-even'
WHERE `range_parity` = '3';

-- Populate streets_relations
INSERT INTO `streets_relations`(`streets_street_id`, `row`)
SELECT `streets_street_id`, `districts_relation_id` FROM `districts_relations`

UPDATE `streets_relations`
SET `table` = 'districts_relations'
WHERE `table` = NULL


-- Batch update of location_id
UPDATE `districts`
SET `districts_location_id` = '1'
WHERE `districts_location_id` = '0'


-- Update all created_on fields
UPDATE `districts`
SET `created_on` = '2012-07-02 00:00:00'
WHERE `created_on` = '0000-00-00 00:00:00';

UPDATE `districts_officers`
SET `created_on` = '2012-07-02 00:00:00'
WHERE `created_on` = '0000-00-00 00:00:00';

UPDATE `districts_relations`
SET `created_on` = '2012-07-02 00:00:00'
WHERE `created_on` = '0000-00-00 00:00:00';

UPDATE `streets`
SET `created_on` = '2012-07-02 00:00:00'
WHERE `created_on` = '0000-00-00 00:00:00';


-- Alter table engine
ALTER TABLE `districts` ENGINE = INNODB;
ALTER TABLE `districts_districts_officers` ENGINE = INNODB;
ALTER TABLE `districts_officers` ENGINE = INNODB;
ALTER TABLE `districts_relations` ENGINE = INNODB;
-- Add constraints
UPDATE `streets` AS `street`, `traffic_streets` AS `traffic_streets`
SET `traffic_streets`.`streets_street_id` = `street`.`streets_street_code`
WHERE `traffic_streets`.`streets_street_id` = `street`.`streets_street_id`;

UPDATE `districts_districts_officers` AS `district_officer`, `districts_officers` AS `officer`
SET `district_officer`.`districts_officer_id` = `officer`.`number`
WHERE `district_officer`.`districts_officer_id` = `officer`.`districts_officer_id`;

UPDATE `districts_districts_officers` AS `district_officer`, `districts` AS `district`
SET `district_officer`.`districts_district_id` = `district`.`districts_district_code`
WHERE `district_officer`.`districts_district_id` = `district`.`districts_district_id`;

ALTER TABLE `districts_districts_officers` ADD CONSTRAINT `districts_districts_officers__districts_officer_id` FOREIGN KEY (`districts_officer_id`) REFERENCES `districts_officers` (`districts_officer_id`) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE `districts_districts_officers` ADD CONSTRAINT `districts_districts_officers__districts_district_id` FOREIGN KEY (`districts_district_id`) REFERENCES `districts` (`districts_district_id`) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE `districts_relations` ADD CONSTRAINT `districts_relations__districts_district_id` FOREIGN KEY (`districts_district_id`) REFERENCES `districts` (`districts_district_id`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `traffic_streets` ADD CONSTRAINT `traffic_streets__traffic_article_id` FOREIGN KEY (`traffic_article_id`) REFERENCES `traffic` (`traffic_article_id`) ON UPDATE CASCADE ON DELETE CASCADE;

-- New import of National Streets from ISLP
-- Set city ID
UPDATE `streets_islp`, `streets_postcodes`
SET `streets_islp`.`streets_city_id` = `streets_postcodes`.`streets_city_id`
WHERE `streets_islp`.`postcode` = `streets_postcodes`.`streets_postcode_id`;

-- Set ISLP code in streets table
UPDATE `streets`, `streets_islp`
SET `streets`.`islp` = `streets_islp`.`islp`
WHERE `streets`.`title` = `streets_islp`.`title` AND `streets`.`streets_city_id` = `streets_islp`.`streets_city_id`;

-- Update traffic_streets to use agiv
UPDATE `traffic_streets`, `streets`
SET `traffic_streets`.`streets_street_id` = `streets`.`streets_street_id`
WHERE `traffic_streets`.`streets_street_id` = `streets`.`islp`;

-- Add police_zone_id to streets_postcodes
UPDATE `streets_postcodes`, `police_municipalities`
SET `streets_postcodes`.`police_zone_id` = `police_municipalities`.`police_zone_id`
WHERE `streets_postcodes`.`streets_postcode_id` = `police_municipalities`.`postcode`;

-- Add police_zone_id to streets_postcodes
UPDATE `streets_cities`, `streets_postcodes`
SET `streets_cities`.`police_zone_id` = `streets_postcodes`.`police_zone_id`
WHERE `streets_cities`.`streets_city_id` = `streets_postcodes`.`streets_city_id`;

-- Release
UPDATE `attachments_relations`, `districts_officers`
SET `attachments_relations`.`row` = `districts_officers`.`districts_officer_id`
WHERE `attachments_relations`.`row` = `districts_officers`.`old_id` AND `attachments_relations`.`table` = 'districts_officers';