-- Check  for wrong links when publishing a site in production
UPDATE `about` set `introtext` = replace(`introtext`, 'http://p.pol-nl.be/', '/');
UPDATE `about` set `introtext` = replace(`introtext`, 'http://p.pol-fr.be/', '/');
UPDATE `about` set `introtext` = replace(`introtext`, 'http://p.pol-de.be/', '/');
UPDATE `about` set `fulltext` = replace(`fulltext`, 'http://p.pol-nl.be/', '/');
UPDATE `about` set `fulltext` = replace(`fulltext`, 'http://p.pol-fr.be/', '/');
UPDATE `about` set `fulltext` = replace(`fulltext`, 'http://p.pol-de.be/', '/');

UPDATE `categories` set `description` = replace(`description`, 'http://p.pol-nl.be/', '/');
UPDATE `categories` set `description` = replace(`description`, 'http://p.pol-fr.be/', '/');
UPDATE `categories` set `description` = replace(`description`, 'http://p.pol-de.be/', '/');

UPDATE `contacts` set `misc` = replace(`misc`, 'http://p.pol-nl.be/', '/');
UPDATE `contacts` set `misc` = replace(`misc`, 'http://p.pol-fr.be/', '/');
UPDATE `contacts` set `misc` = replace(`misc`, 'http://p.pol-de.be/', '/');

UPDATE `news` set `introtext` = replace(`introtext`, 'http://p.pol-nl.be/', '/');
UPDATE `news` set `introtext` = replace(`introtext`, 'http://p.pol-fr.be/', '/');
UPDATE `news` set `introtext` = replace(`introtext`, 'http://p.pol-de.be/', '/');
UPDATE `news` set `fulltext` = replace(`fulltext`, 'http://p.pol-nl.be/', '/');
UPDATE `news` set `fulltext` = replace(`fulltext`, 'http://p.pol-fr.be/', '/');
UPDATE `news` set `fulltext` = replace(`fulltext`, 'http://p.pol-de.be/', '/');

UPDATE `press` set `text` = replace(`text`, 'http://p.pol-nl.be/', '/');
UPDATE `press` set `text` = replace(`text`, 'http://p.pol-fr.be/', '/');
UPDATE `press` set `text` = replace(`text`, 'http://p.pol-de.be/', '/');

UPDATE `questions` set `text` = replace(`text`, 'http://p.pol-nl.be/', '/');
UPDATE `questions` set `text` = replace(`text`, 'http://p.pol-fr.be/', '/');
UPDATE `questions` set `text` = replace(`text`, 'http://p.pol-de.be/', '/');

UPDATE `traffic` set `text` = replace(`text`, 'http://p.pol-nl.be/', '/');
UPDATE `traffic` set `text` = replace(`text`, 'http://p.pol-fr.be/', '/');
UPDATE `traffic` set `text` = replace(`text`, 'http://p.pol-de.be/', '/');