# After Nooku migration

UPDATE `pages_modules` SET `name` = 'mod_contact' WHERE `name` = 'mod_contact_info';
UPDATE `pages_modules` SET `extensions_component_id` = 38 WHERE `name` = 'mod_contact';

UPDATE `pages_modules` SET `name` = 'mod_telephone' WHERE `name` = 'mod_call_us';
UPDATE `pages_modules` SET `extensions_component_id` = 38 WHERE `name` = 'mod_telephone';
UPDATE `pages_modules` SET `position` = 'telephone' WHERE `name` = 'mod_telephone';

DELETE FROM `pages_modules` WHERE `name` = 'mod_sitename';