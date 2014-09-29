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

-- Remove articles that are not published on the frontpage
DELETE FROM `pol_content_copy`
WHERE `id` NOT IN (SELECT `content_id` FROM `pol_content_frontpage`);

-- Assign category to frontpage articles
UPDATE `pol_content_frontpage` AS `frontpage`, `pol_content_copy` AS `content`
SET `content`.`catid` = '1', `content`.`sectionid` = '1'
WHERE `content`.`id` = `frontpage`.`content_id`;


-- Update links in quicklinks
UPDATE `5353`.`pages_modules` set `content` = replace(`content`, '5388', '5353');


-- Add some sample questions and category
INSERT INTO `questions_categories` (`questions_category_id`, `parent_id`, `attachments_attachment_id`, `title`, `slug`, `image`, `description`, `published`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `ordering`, `access`, `params`)
VALUES
	(1, 0, 0, 'Aangifte', 'aangifte', '', '', 1, 1, now(), NULL, NULL, NULL, NULL, 1, 0, ''),
	(2, 0, 0, 'Verlies of diefstal', 'verlies-of-diefstal', '', '', 1, 1, now(), NULL, NULL, NULL, NULL, 2, 0, ''),
	(3, 0, 0, 'Vergunningen', 'vergunningen', '', '', 1, 1, now(), NULL, NULL, NULL, NULL, 3, 0, ''),
	(4, 0, 0, 'Preventie', 'preventie', '', '', 1, 1, now(), NULL, NULL, NULL, NULL, 4, 0, '');

INSERT INTO `questions` (`questions_question_id`, `questions_category_id`, `attachments_attachment_id`, `title`, `slug`, `text`, `published`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `ordering`, `params`)
VALUES
	(1, 1, 0, 'Hoe aangifte doen?', 'hoe-aangifte-doen', '<p>Placeholder</p>', 1, 1, now(), NULL, NULL, NULL, NULL, 1, ''),
	(2, 4, 0, 'Hoe afwezigheidstoezicht aanvragen?', 'hoe-afwezigheidstoezicht-aanvragen', '<p>Placeholder</p>', 1, 1, now(), NULL, NULL, NULL, NULL, 1, ''),
	(3, 2, 0, 'Ik ben iets kwijt, wat nu?', 'ik-ben-iets-kwijt-wat-nu', '<p>Placeholder</p>', 1, 1, now(), NULL, NULL, NULL, NULL, 1, '');


-- Add some sample questions and category
INSERT INTO `questions_categories` (`questions_category_id`, `parent_id`, `attachments_attachment_id`, `title`, `slug`, `image`, `description`, `published`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `ordering`, `access`, `params`)
VALUES
	(1, 0, 0, 'Déclaration', 'declaration', '', '', 1, 1, now(), NULL, NULL, NULL, NULL, 1, 0, ''),
	(2, 0, 0, 'Perte ou vol', 'perte-ou-vol', '', '', 1, 1, now(), NULL, NULL, NULL, NULL, 2, 0, ''),
	(3, 0, 0, 'Autorisation', 'autorisation', '', '', 1, 1, now(), NULL, NULL, NULL, NULL, 3, 0, ''),
	(4, 0, 0, 'Prévention', 'prevention', '', '', 1, 1, now(), NULL, NULL, NULL, NULL, 4, 0, '');

INSERT INTO `questions` (`questions_question_id`, `questions_category_id`, `attachments_attachment_id`, `title`, `slug`, `text`, `published`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `ordering`, `params`)
VALUES
	(1, 1, 0, 'Comment déposer plainte?', 'comment-deposer-plainte', '<p>Placeholder</p>', 1, 1, now(), NULL, NULL, NULL, NULL, 1, ''),
	(2, 4, 0, 'Comment demander une surveillance habitation pendant ses vacances?', 'comment-demander-une-surveillance-habitation-pendant-ses-vacances', '<p>Placeholder</p>', 1, 1, now(), NULL, NULL, NULL, NULL, 1, ''),
	(3, 2, 0, 'Objets perdus', 'objets-perdus', '<p>Placeholder</p>', 1, 1, now(), NULL, NULL, NULL, NULL, 1, '');

