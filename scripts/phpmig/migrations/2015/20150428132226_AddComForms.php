<?php

use MyPhpmig\Police\Migration;

class AddComForms extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = <<<EOL

-- Create syntax for TABLE 'forms'
CREATE TABLE `forms` (
  `forms_form_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `text` mediumtext,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `locked_by` int(11) unsigned DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  `params` text,
  PRIMARY KEY (`forms_form_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'forms_entries'
CREATE TABLE `forms_entries` (
  `forms_entry_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `forms_form_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `text` text NOT NULL,
  `validation` text NOT NULL,
  `is_valid` tinyint(1) DEFAULT '0',
  `created_by` int(11) unsigned DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(11) unsigned DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(11) unsigned DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  PRIMARY KEY (`forms_entry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `extensions` (`extensions_extension_id`, `title`, `name`, `params`, `enabled`)
VALUES
	(52, 'Forms', 'com_forms', '', 1);

INSERT INTO `pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
VALUES
	(121, 1, 0, 'Forms', 'forms', 'option=com_forms&view=forms', NULL, 'component', 1, 1, 0, 52, 1, '2015-04-28 13:50:35', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"');

INSERT INTO `pages_closures` (`ancestor_id`, `descendant_id`, `level`)
VALUES
	(121, 121, 0);

INSERT INTO `pages_orderings` (`pages_page_id`, `title`, `custom`)
VALUES
	(121, 00000000004, 00000000014);

EOL;

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        parent::up();
    }
}
