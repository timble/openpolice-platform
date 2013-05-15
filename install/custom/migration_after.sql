# After Nooku migration

UPDATE `pages_modules` SET `name` = 'mod_contact' WHERE `name` = 'mod_contact_info';
UPDATE `pages_modules` SET `extensions_component_id` = 38 WHERE `name` = 'mod_contact';

UPDATE `pages_modules` SET `name` = 'mod_telephone' WHERE `name` = 'mod_call_us';
UPDATE `pages_modules` SET `extensions_component_id` = 38 WHERE `name` = 'mod_telephone';
UPDATE `pages_modules` SET `position` = 'telephone' WHERE `name` = 'mod_telephone';

DELETE FROM `pages_modules` WHERE `name` = 'mod_sitename';


RENAME TABLE `pol_content` TO `news`;

-- Update schema to follow conventions
ALTER TABLE `news` CHANGE `id` `news_article_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `news` ADD `image` varchar(255) AFTER `fulltext`;
ALTER TABLE `news` ADD `sticky` tinyint(1) AFTER `image`;

ALTER TABLE `news` CHANGE  `attribs`  `params` TEXT;
ALTER TABLE `news` CHANGE  `state`  `published` TINYINT(1);
ALTER TABLE `news` CHANGE  `alias`  `slug` VARCHAR(250);
ALTER TABLE `news` CHANGE  `created`  `created_on` DATETIME;
ALTER TABLE `news` CHANGE  `modified`  `modified_on` DATETIME;
ALTER TABLE `news` CHANGE  `checked_out`  `locked_by` INT(11) UNSIGNED;
ALTER TABLE `news` CHANGE  `checked_out_time`  `locked_on` DATETIME;
ALTER TABLE `news` CHANGE  `publish_up`  `publish_on` DATETIME;
ALTER TABLE `news` CHANGE  `publish_down`  `unpublish_on` DATETIME;

-- Remove unused columns
ALTER TABLE `news` DROP `catid`;
ALTER TABLE `news` DROP `metadesc`;
ALTER TABLE `news` DROP `title_alias`;
ALTER TABLE `news` DROP `mask`;
ALTER TABLE `news` DROP `images`;
ALTER TABLE `news` DROP `urls`;
ALTER TABLE `news` DROP `version`;
ALTER TABLE `news` DROP `parentid`;
ALTER TABLE `news` DROP `hits`;
ALTER TABLE `news` DROP `sectionid`;
ALTER TABLE `news` DROP `created_by_alias`;
ALTER TABLE `news` DROP `metakey`;
ALTER TABLE `news` DROP `metadata`;
ALTER TABLE `news` DROP `access`;
ALTER TABLE `news` DROP `ordering`;

ALTER TABLE `news` DROP INDEX `idx_checkout`;