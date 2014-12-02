-- Find and Replace
UPDATE `about` set `introtext` = replace(`introtext`, 'find', 'replace');
UPDATE `about_categories` set `description` = replace(`description`, 'find', 'replace');
UPDATE `categories` set `description` = replace(`description`, 'find', 'replace');
UPDATE `contacts` set `misc` = replace(`misc`, 'find', 'replace');
UPDATE `contacts_categories` set `description` = replace(`description`, 'find', 'replace');
UPDATE `news` set `introtext` = replace(`introtext`, 'find', 'replace');
UPDATE `news` set `fulltext` = replace(`fulltext`, 'find', 'replace');
UPDATE `press` set `text` = replace(`text`, 'find', 'replace');
UPDATE `questions` set `text` = replace(`text`, 'find', 'replace');
UPDATE `questions_categories` set `description` = replace(`description`, 'find', 'replace');
UPDATE `traffic` set `text` = replace(`text`, 'find', 'replace');
UPDATE `traffic_categories` set `description` = replace(`description`, 'find', 'replace');