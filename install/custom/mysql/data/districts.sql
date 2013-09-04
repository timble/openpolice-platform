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


-- Update national streets table with zones_zone_id
UPDATE `streets` AS `street`, `police_districts-joomla`.`zones_municipalities` AS `municipality`
SET `street`.`zones_zone_id` = `municipality`.`zones_zone_id`
WHERE `street`.`postcode` = `municipality`.`postcode`;