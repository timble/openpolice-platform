ALTER TABLE `pol_content` ENGINE = INNODB;

-- Delete everything that is not in the 'news' category
DELETE FROM `pol_content` WHERE `catid` != '1';

-- Clean trash
DELETE FROM `pol_content` WHERE `state` = '-2';

-- Update schema to follow conventions
ALTER TABLE `pol_content` CHANGE `id` `news_article_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `pol_content` ADD `attachments_attachment_id` INT(11) UNSIGNED NOT NULL DEFAULT '0' AFTER `news_article_id`;
ALTER TABLE `pol_content` ADD `sticky` tinyint(1) AFTER `fulltext`;

ALTER TABLE `pol_content` CHANGE  `attribs`  `params` TEXT;
ALTER TABLE `pol_content` CHANGE  `state`  `published` TINYINT(1);
ALTER TABLE `pol_content` CHANGE  `alias`  `slug` VARCHAR(250);
ALTER TABLE `pol_content` CHANGE  `created`  `created_on` DATETIME;
ALTER TABLE `pol_content` CHANGE  `modified`  `modified_on` DATETIME;
ALTER TABLE `pol_content` CHANGE  `checked_out`  `locked_by` INT(11) UNSIGNED;
ALTER TABLE `pol_content` CHANGE  `checked_out_time`  `locked_on` DATETIME;
ALTER TABLE `pol_content` CHANGE  `publish_up`  `publish_on` DATETIME;
ALTER TABLE `pol_content` CHANGE  `publish_down`  `unpublish_on` DATETIME;

-- Remove unused columns
ALTER TABLE `pol_content` DROP `catid`;
ALTER TABLE `pol_content` DROP `metadesc`;
ALTER TABLE `pol_content` DROP `title_alias`;
ALTER TABLE `pol_content` DROP `mask`;
ALTER TABLE `pol_content` DROP `images`;
ALTER TABLE `pol_content` DROP `urls`;
ALTER TABLE `pol_content` DROP `version`;
ALTER TABLE `pol_content` DROP `parentid`;
ALTER TABLE `pol_content` DROP `hits`;
ALTER TABLE `pol_content` DROP `sectionid`;
ALTER TABLE `pol_content` DROP `created_by_alias`;
ALTER TABLE `pol_content` DROP `metakey`;
ALTER TABLE `pol_content` DROP `metadata`;
ALTER TABLE `pol_content` DROP `access`;
ALTER TABLE `pol_content` DROP `ordering`;

ALTER TABLE `pol_content` DROP INDEX `idx_checkout`;

-- Update image links
UPDATE `pol_content` set `introtext` = replace(`introtext`, 'sites/5388/images/Nieuws/', 'files/nieuws/');
UPDATE `pol_content` set `fulltext` = replace(`fulltext`, 'sites/5388/images/Nieuws/', 'files/nieuws/');
UPDATE `pol_content` set `introtext` = replace(`introtext`, '<img', '<img class="article__thumbnail"');

RENAME TABLE `pol_content` TO `news`;

-- Assign category to frontpage articles
UPDATE `pol_content_frontpage` AS `frontpage`, `pol_content` AS `content`
SET `content`.`catid` = '1', `content`.`sectionid` = '1'
WHERE `content`.`id` = `frontpage`.`content_id` AND `content`.`catid` = '0';