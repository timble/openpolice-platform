<?php

use MyPhpmig\Police\Migration;

class AddMultilingual extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "UPDATE `pages` SET `title` = 'Tables', `slug` = 'tables', `link_url` = 'option=com_languages&view=tables' WHERE `pages_page_id` = '23';";
        $this->_queries .= "UPDATE `pages_closures` SET `ancestor_id` = '9' WHERE `ancestor_id` = '4' AND `descendant_id` IN ('15', '22', '23') AND `level` = '1';";
        $this->_queries .= "UPDATE `pages_orderings` SET `custom` = '00000000005' WHERE `pages_page_id` IN ('15');";

        // Decouple categories table to about_categories
        $this->_queries .= "CREATE TABLE IF NOT EXISTS `about_categories` LIKE `categories`;";
        $this->_queries .= "INSERT `about_categories` SELECT * FROM `categories` WHERE `table` = 'about';";
        $this->_queries .= "ALTER TABLE `about_categories` CHANGE `categories_category_id` `about_category_id` INT(11)  NOT NULL  AUTO_INCREMENT;";
        $this->_queries .= "ALTER TABLE `about_categories` DROP `table`;";
        $this->_queries .= "ALTER TABLE `about` CHANGE `categories_category_id` `about_category_id` INT(11)  NOT NULL  DEFAULT '0';";

        // Decouple categories table to questions_categories
        $this->_queries .= "CREATE TABLE IF NOT EXISTS `questions_categories` LIKE `categories`;";
        $this->_queries .= "INSERT `questions_categories` SELECT * FROM `categories` WHERE `table` = 'questions';";
        $this->_queries .= "ALTER TABLE `questions_categories` CHANGE `categories_category_id` `questions_category_id` INT(11)  NOT NULL  AUTO_INCREMENT;";
        $this->_queries .= "ALTER TABLE `questions_categories` DROP `table`;";
        $this->_queries .= "ALTER TABLE `questions` CHANGE `categories_category_id` `questions_category_id` INT(11)  NOT NULL  DEFAULT '0';";

        // Decouple categories table to traffic_categories
        $this->_queries .= "CREATE TABLE IF NOT EXISTS `traffic_categories` LIKE `categories`;";
        $this->_queries .= "INSERT `traffic_categories` SELECT * FROM `categories` WHERE `table` = 'traffic';";
        $this->_queries .= "ALTER TABLE `traffic_categories` CHANGE `categories_category_id` `traffic_category_id` INT(11)  NOT NULL  AUTO_INCREMENT;";
        $this->_queries .= "ALTER TABLE `traffic_categories` DROP `table`;";
        $this->_queries .= "ALTER TABLE `traffic` CHANGE `categories_category_id` `traffic_category_id` INT(11)  NOT NULL  DEFAULT '0';";

        // Decouple categories table to contacts_categories
        $this->_queries .= "CREATE TABLE IF NOT EXISTS `contacts_categories` LIKE `categories`;";
        $this->_queries .= "INSERT `contacts_categories` SELECT * FROM `categories` WHERE `table` IN ('contacts', 'districts', 'bin');";
        $this->_queries .= "ALTER TABLE `contacts_categories` CHANGE `categories_category_id` `contacts_category_id` INT(11)  NOT NULL  AUTO_INCREMENT;";
        $this->_queries .= "ALTER TABLE `contacts_categories` DROP `table`;";
        $this->_queries .= "ALTER TABLE `contacts` CHANGE `categories_category_id` `contacts_category_id` INT(11)  NOT NULL  DEFAULT '0';";

        $this->_queries .= "DELETE FROM `categories`;";

        $this->_queries .= "DELETE FROM `languages_tables`;";

        $this->_queries .= "DELETE FROM `languages`;";
        $this->_queries .= "INSERT INTO `languages` (`languages_language_id`, `application`, `name`, `native_name`, `iso_code`, `slug`, `enabled`, `primary`)
                            VALUES
                                (1, 'admin', 'Dutch', 'Dutch', 'nl-NL', 'nl', 0, 0),
                                (2, 'site', 'Dutch', 'Dutch', 'nl-NL', 'nl', 0, 0),
                                (3, 'admin', 'French', 'French', 'fr-FR', 'fr', 0, 0),
                                (4, 'site', 'French', 'French', 'fr-FR', 'fr', 0, 0);";
        parent::up();


        // All the Dutch speaking zones.
        $this->getZones()->where('language', '=', 1);

        $this->_queries = "UPDATE `languages` SET `enabled` = '1', `primary` = '1' WHERE `languages_language_id` IN ('1', '2');";

        parent::up();


        // All the French speaking zones.
        $this->getZones()->reset()->where('language', '=', 2);

        $this->_queries = "UPDATE `languages` SET `enabled` = '1', `primary` = '1' WHERE `languages_language_id` IN ('3', '4');";

        parent::up();


        // All the multilingual zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "UPDATE `pages` SET `published` = '1' WHERE `pages_page_id` IN ('15', '22', '23');";

        $this->_queries .= "UPDATE `languages` SET `enabled` = '1' WHERE `languages_language_id` IN ('1', '2', '3', '4');";
        $this->_queries .= "UPDATE `languages` SET `primary` = '1' WHERE `languages_language_id` IN ('1', '2');";

        $this->_queries .= "INSERT INTO `languages_tables` (`languages_table_id`, `extensions_extension_id`, `name`, `unique_column`, `enabled`)
                            VALUES
                                (1, 25, 'pages', 'pages_page_id', 1),
                                (2, 7,  'contacts', 'contacts_contact_id', 0),
                                (3, 7,  'contacts_categories', 'categories_category_id', 0),
                                (4, 37, 'traffic', 'traffic_article_id', 0),
                                (5, 37, 'traffic_categories', 'categories_category_id', 0),
                                (6, 38, 'news', 'news_article_id', 0),
                                (7, 40, 'questions', 'questions_question_id', 0),
                                (8, 40, 'questions_categories', 'questions_category_id', 0),
                                (9, 43, 'about', 'about_article_id', 0),
                                (10, 43, 'about_categories', 'categories_category_id', 0),
                                (11, 45, 'press', 'press_article_id', 0),
                                (12, 36, 'districts', 'districts_district_id', 0);";

        $this->_queries .= "CREATE TABLE `fr-fr_pages` (
                              `pages_page_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                              `pages_menu_id` int(10) unsigned NOT NULL,
                              `users_group_id` int(10) unsigned NOT NULL,
                              `title` varchar(255) NOT NULL,
                              `slug` varchar(255) DEFAULT NULL,
                              `link_url` text,
                              `link_id` int(11) unsigned DEFAULT NULL,
                              `type` varchar(50) DEFAULT NULL,
                              `published` tinyint(1) NOT NULL DEFAULT '0',
                              `hidden` tinyint(1) NOT NULL DEFAULT '0',
                              `home` tinyint(1) NOT NULL DEFAULT '0',
                              `extensions_extension_id` int(10) unsigned DEFAULT NULL,
                              `created_by` int(10) unsigned DEFAULT NULL,
                              `created_on` datetime DEFAULT NULL,
                              `modified_by` int(10) unsigned DEFAULT NULL,
                              `modified_on` datetime DEFAULT NULL,
                              `locked_by` int(10) unsigned DEFAULT NULL,
                              `locked_on` datetime DEFAULT NULL,
                              `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
                              `params` text,
                              PRIMARY KEY (`pages_page_id`),
                              KEY `pages__pages_menu_id` (`pages_menu_id`),
                              KEY `pages__link_id` (`link_id`),
                              KEY `ix_published` (`published`),
                              KEY `ix_home` (`home`),
                              KEY `ix_extensions_extension_id` (`extensions_extension_id`)
                            ) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;";

        $this->_queries .= "INSERT INTO `fr-fr_pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
                            VALUES
                                (1, 1, 0, 'Home', 'home', 'option=com_police&view=page&layout=homepage', NULL, 'component', 1, 1, 1, 41, 1, NULL, NULL, NULL, NULL, NULL, 0, 'page_title=\"Police Comines-Warneton\"'),
                                (2, 2, 0, 'Dashboard', 'dashboard', 'option=com_dashboard&view=dashboard', NULL, 'component', 1, 0, 0, 35, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (3, 2, 1, 'Pages', 'pages', 'option=com_pages&view=pages', NULL, 'component', 1, 0, 0, 25, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (4, 2, 0, 'Contenu', 'content', NULL, NULL, 'separator', 1, 0, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (5, 2, 0, 'Fichiers', 'files', 'option=com_files&view=files', NULL, 'component', 1, 0, 0, 19, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (6, 2, 1, 'Users', 'users', 'option=com_users&view=users', NULL, 'component', 1, 0, 0, 31, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (7, 2, 1, 'Extensions', 'extensions', NULL, NULL, 'separator', 1, 0, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (8, 2, 1, 'Settings', 'settings', 'option=com_extensions&view=settings', NULL, 'component', 1, 0, 0, 28, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (9, 2, 0, 'Outils', 'tools', NULL, NULL, 'separator', 1, 0, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (10, 2, 1, 'Registre', 'activity-logs', 'option=com_activities&view=activities', NULL, 'component', 1, 0, 0, 34, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (11, 2, 1, 'Clean Cache', 'clean-cache', 'option=com_cache&view=items', NULL, 'component', 1, 0, 0, 32, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (12, 2, 1, 'Articles', 'articles', 'option=com_articles&view=articles', NULL, 'component', 0, 0, 0, 20, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (14, 2, 0, 'Contact', 'contacts', 'option=com_contacts&view=contacts', NULL, 'component', 1, 0, 0, 7, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (15, 2, 1, 'Languages', 'languages', 'option=com_languages&view=languages', NULL, 'component', 0, 0, 0, 23, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (16, 2, 1, 'Articles', 'articles', 'option=com_articles&view=articles', NULL, 'component', 0, 0, 0, 20, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (17, 2, 1, 'Categories', 'categories', 'option=com_articles&view=categories', NULL, 'component', 0, 0, 0, 20, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (20, 2, 0, 'Contacts', 'contacts', 'option=com_contacts&view=contacts', NULL, 'component', 1, 0, 0, 7, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (21, 2, 0, 'Catégories', 'categories', 'option=com_contacts&view=categories', NULL, 'component', 1, 0, 0, 7, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (22, 2, 1, 'Languages', 'languages', 'option=com_languages&view=languages', NULL, 'component', 0, 0, 0, 23, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (23, 2, 1, 'Tables', 'tables', 'option=com_languages&view=tables', NULL, 'component', 0, 0, 0, 23, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (24, 2, 1, 'Pages', 'pages', 'option=com_pages&view=pages', NULL, 'component', 1, 0, 0, 25, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (25, 2, 1, 'Menus', 'menus', 'option=com_pages&view=menus', NULL, 'component', 1, 0, 0, 25, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (26, 2, 1, 'Modules', 'modules', 'option=com_pages&view=modules', NULL, 'component', 1, 0, 0, 25, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (27, 2, 1, 'Users', 'users', 'option=com_users&view=users', NULL, 'component', 1, 0, 0, 31, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (28, 2, 1, 'Groups', 'groups', 'option=com_users&view=groups', NULL, 'component', 1, 0, 0, 31, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (29, 2, 1, 'Items', 'items', 'option=com_cache&view=items', NULL, 'component', 1, 0, 0, 32, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (30, 2, 1, 'Groups', 'groups', 'option=com_cache&view=groups', NULL, 'component', 1, 0, 0, 32, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (31, 2, 1, 'Terms', 'terms', 'option=com_articles&view=terms', NULL, 'component', 0, 0, 0, 20, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
                                (32, 2, 0, 'Questions', 'questions', 'option=com_questions&view=questions', NULL, 'component', 1, 0, 0, 40, 1, '2013-04-28 19:35:06', NULL, NULL, NULL, NULL, 0, NULL),
                                (33, 2, 0, 'Questions', 'questions', 'option=com_questions&view=questions', NULL, 'component', 1, 0, 0, 40, 1, '2013-04-28 19:35:47', NULL, NULL, NULL, NULL, 0, NULL),
                                (34, 2, 0, 'Catégories', 'categories', 'option=com_questions&view=categories', NULL, 'component', 1, 0, 0, 40, 1, '2013-04-28 19:36:02', NULL, NULL, NULL, NULL, 0, NULL),
                                (36, 1, 0, 'Questions', 'questions', 'option=com_questions&view=questions', NULL, 'component', 1, 0, 0, 40, 1, '2013-04-28 19:37:58', NULL, NULL, NULL, NULL, 0, NULL),
                                (37, 1, 0, 'Nouvelles', 'nouvelles', 'option=com_news&view=articles', NULL, 'component', 1, 0, 0, 38, 1, '2013-04-28 19:41:46', NULL, NULL, NULL, NULL, 0, NULL),
                                (39, 1, 0, 'Circulation', 'circulation', 'option=com_traffic&view=categories', NULL, 'component', 1, 0, 0, 37, 1, '2013-04-28 19:44:21', NULL, NULL, NULL, NULL, 0, NULL),
                                (40, 1, 0, 'A propos', 'a-propos', 'option=com_about&view=categories', NULL, 'component', 1, 0, 0, 43, 1, '2013-04-28 19:50:18', NULL, NULL, NULL, NULL, 0, NULL),
                                (41, 1, 0, 'Contact', 'contact', 'option=com_contacts&view=categories', NULL, 'component', 1, 0, 0, 20, 1, '2013-04-28 19:50:47', NULL, NULL, NULL, NULL, 0, NULL),
                                (42, 1, 0, 'Commissariats‎', 'commissariats', 'option=com_contacts&view=contacts&category=1', NULL, 'component', 1, 0, 0, 7, 1, '2013-04-28 19:52:30', NULL, NULL, NULL, NULL, 0, NULL),
                                (43, 1, 0, 'Votre agent de quartier', 'votre-agent-de-quartier', 'option=com_districts&view=relations', NULL, 'component', 1, 0, 0, 36, 1, '2013-04-28 19:52:41', NULL, NULL, NULL, NULL, 0, NULL),
                                (44, 1, 0, 'Services', 'services', 'option=com_contacts&view=contacts&category=2', NULL, 'component', 1, 0, 0, 7, 1, '2013-04-28 19:52:53', NULL, NULL, NULL, NULL, 0, NULL),
                                (45, 2, 0, 'Nouvelles', 'news', 'option=com_news&view=articles', NULL, 'component', 1, 0, 0, 38, 1, '2013-04-28 20:05:02', NULL, NULL, NULL, NULL, 0, NULL),
                                (47, 2, 0, 'Circulation', 'traffic', 'option=com_traffic&view=articles', NULL, 'component', 1, 0, 0, 37, 1, '2013-05-11 15:29:00', NULL, NULL, NULL, NULL, 0, NULL),
                                (53, 2, 0, 'Quartiers', 'districts', 'option=com_districts&view=districts', NULL, 'component', 1, 0, 0, 36, 1, '2013-05-12 14:37:42', NULL, NULL, NULL, NULL, 0, NULL),
                                (54, 2, 0, 'Quartiers', 'districts', 'option=com_districts&view=districts', NULL, 'component', 1, 0, 0, 36, 1, '2013-05-12 14:37:52', NULL, NULL, NULL, NULL, 0, NULL),
                                (55, 2, 0, 'Agents de quartier', 'officers', 'option=com_districts&view=officers', NULL, 'component', 1, 0, 0, 36, 1, '2013-05-12 14:38:01', NULL, NULL, NULL, NULL, 0, NULL),
                                (56, 2, 0, 'Quartiers - Rues', 'relations', 'option=com_districts&view=relations', NULL, 'component', 1, 0, 0, 36, 1, '2013-05-12 14:38:14', NULL, NULL, NULL, NULL, 0, NULL),
                                (57, 2, 0, 'Rues', 'streets', 'option=com_streets&view=streets', NULL, 'component', 1, 0, 0, 39, 1, '2013-05-12 14:38:41', NULL, NULL, NULL, NULL, 0, NULL),
                                (66, 1, 0, 'Des numéros d\'urgence', 'des-numeros-durgence', 'option=com_contacts&view=contacts&category=18', NULL, 'component', 1, 0, 0, 7, 1, '2013-05-13 14:28:47', NULL, NULL, NULL, NULL, 0, NULL),
                                (89, 1, 0, 'Downloads', 'downloads', 'option=com_files&view=directory&folder=downloads&layout=table', NULL, 'component', 1, 1, 0, 19, 1, '2013-05-17 12:50:26', NULL, NULL, NULL, NULL, 0, 'show_folders=\"1\"\nhumanize_filenames=\"1\"\nlimit=\"-1\"\nsort=\"name\"\ndirection=\"asc\"\npage_title=\"\"'),
                                (92, 2, 0, 'Support', 'support', 'option=com_support&view=tickets', NULL, 'component', 1, 0, 0, 42, 1, '2013-09-25 13:36:11', NULL, NULL, NULL, NULL, 0, NULL),
                                (93, 2, 0, 'A propos', 'about-us', 'option=com_about&view=articles', NULL, 'component', 1, 0, 0, 43, 1, '2013-10-03 14:41:43', NULL, NULL, NULL, NULL, 0, NULL),
                                (94, 2, 0, 'Articles', 'articles', 'option=com_about&view=articles', NULL, 'component', 1, 0, 0, 43, 1, '2013-10-03 14:42:47', NULL, NULL, NULL, NULL, 0, NULL),
                                (95, 2, 0, 'Catégories', 'categories', 'option=com_about&view=categories', NULL, 'component', 1, 0, 0, 43, 1, '2013-10-03 14:42:55', NULL, NULL, NULL, NULL, 0, NULL),
                                (96, 2, 0, 'Circulation', 'traffic', 'option=com_traffic&view=articles', NULL, 'component', 1, 0, 0, 37, 1, '2014-01-17 14:56:07', NULL, NULL, NULL, NULL, 0, ''),
                                (97, 2, 0, 'Categories', 'categories', 'option=com_traffic&view=categories', NULL, 'component', 1, 0, 0, 37, 1, '2014-01-17 14:56:18', NULL, NULL, NULL, NULL, 0, ''),
                                (98, 2, 0, 'Heures d\'ouverture', 'hours', 'option=com_contacts&view=hours', NULL, 'component', 1, 0, 0, 7, 1, '2014-02-13 11:14:14', NULL, NULL, NULL, NULL, 0, ''),
                                (99, 2, 1, 'Import', 'import', 'option=com_uploads&view=uploads', NULL, 'component', 1, 0, 0, 44, 1, '2014-04-23 13:50:40', NULL, NULL, NULL, NULL, 0, ''),
                                (100, 2, 0, 'Presse', 'press', 'option=com_press&view=articles', NULL, 'component', 0, 0, 0, 45, 1, '2014-04-25 09:36:08', NULL, NULL, NULL, NULL, 0, ''),
                                (101, 1, 0, 'Presse', 'presse', 'option=com_press&view=articles', NULL, 'component', 0, 1, 0, 45, 1, '2014-04-25 09:51:10', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"'),
                                (102, 2, 0, 'RIQ', 'bin', 'option=com_bin&view=districts', NULL, 'component', 0, 0, 0, 46, 1, '2014-06-11 09:24:40', NULL, NULL, NULL, NULL, 0, ''),
                                (103, 2, 0, 'Quartiers', 'districts', 'option=com_bin&view=districts', NULL, 'component', 0, 0, 0, 46, 1, '2014-06-11 09:24:50', NULL, NULL, NULL, NULL, 0, ''),
                                (104, 2, 0, 'Quartiers - Rues', 'relations', 'option=com_bin&view=relations', NULL, 'component', 0, 0, 0, 46, 1, '2014-06-11 09:25:13', NULL, NULL, NULL, NULL, 0, ''),
                                (105, 1, 0, 'Réseau d\'Information de Quartier', 'reseau-information-de-quartier', 'option=com_bin&view=relations', NULL, 'component', 0, 0, 0, 46, 1, '2014-06-11 09:48:59', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"');";

        $this->_queries .= "INSERT INTO `languages_translations` (`languages_translation_id`, `iso_code`, `table`, `row`, `status`, `original`, `deleted`)
                            VALUES
                                (1, 'nl-NL', 'pages', 12, 1, 1, 0),
                                (2, 'nl-NL', 'pages', 16, 1, 1, 0),
                                (3, 'nl-NL', 'pages', 17, 1, 1, 0),
                                (4, 'nl-NL', 'pages', 31, 1, 1, 0),
                                (5, 'nl-NL', 'pages', 100, 1, 1, 0),
                                (6, 'nl-NL', 'pages', 101, 1, 1, 0),
                                (7, 'nl-NL', 'pages', 102, 1, 1, 0),
                                (8, 'nl-NL', 'pages', 103, 1, 1, 0),
                                (9, 'nl-NL', 'pages', 104, 1, 1, 0),
                                (10, 'nl-NL', 'pages', 105, 1, 1, 0),
                                (11, 'nl-NL', 'pages', 1, 1, 1, 0),
                                (12, 'nl-NL', 'pages', 2, 1, 1, 0),
                                (13, 'nl-NL', 'pages', 3, 1, 1, 0),
                                (14, 'nl-NL', 'pages', 4, 1, 1, 0),
                                (15, 'nl-NL', 'pages', 5, 1, 1, 0),
                                (16, 'nl-NL', 'pages', 6, 1, 1, 0),
                                (17, 'nl-NL', 'pages', 7, 1, 1, 0),
                                (18, 'nl-NL', 'pages', 8, 1, 1, 0),
                                (19, 'nl-NL', 'pages', 9, 1, 1, 0),
                                (20, 'nl-NL', 'pages', 10, 1, 1, 0),
                                (21, 'nl-NL', 'pages', 11, 1, 1, 0),
                                (22, 'nl-NL', 'pages', 14, 1, 1, 0),
                                (23, 'nl-NL', 'pages', 15, 1, 1, 0),
                                (24, 'nl-NL', 'pages', 20, 1, 1, 0),
                                (25, 'nl-NL', 'pages', 21, 1, 1, 0),
                                (26, 'nl-NL', 'pages', 22, 1, 1, 0),
                                (27, 'nl-NL', 'pages', 23, 1, 1, 0),
                                (28, 'nl-NL', 'pages', 24, 1, 1, 0),
                                (29, 'nl-NL', 'pages', 25, 1, 1, 0),
                                (30, 'nl-NL', 'pages', 26, 1, 1, 0),
                                (31, 'nl-NL', 'pages', 27, 1, 1, 0),
                                (32, 'nl-NL', 'pages', 28, 1, 1, 0),
                                (33, 'nl-NL', 'pages', 29, 1, 1, 0),
                                (34, 'nl-NL', 'pages', 30, 1, 1, 0),
                                (35, 'nl-NL', 'pages', 32, 1, 1, 0),
                                (36, 'nl-NL', 'pages', 33, 1, 1, 0),
                                (37, 'nl-NL', 'pages', 34, 1, 1, 0),
                                (38, 'nl-NL', 'pages', 36, 1, 1, 0),
                                (39, 'nl-NL', 'pages', 37, 1, 1, 0),
                                (40, 'nl-NL', 'pages', 39, 1, 1, 0),
                                (41, 'nl-NL', 'pages', 40, 1, 1, 0),
                                (42, 'nl-NL', 'pages', 41, 1, 1, 0),
                                (43, 'nl-NL', 'pages', 42, 1, 1, 0),
                                (44, 'nl-NL', 'pages', 43, 1, 1, 0),
                                (45, 'nl-NL', 'pages', 44, 1, 1, 0),
                                (46, 'nl-NL', 'pages', 45, 1, 1, 0),
                                (47, 'nl-NL', 'pages', 47, 1, 1, 0),
                                (48, 'nl-NL', 'pages', 53, 1, 1, 0),
                                (49, 'nl-NL', 'pages', 54, 1, 1, 0),
                                (50, 'nl-NL', 'pages', 55, 1, 1, 0),
                                (51, 'nl-NL', 'pages', 56, 1, 1, 0),
                                (52, 'nl-NL', 'pages', 57, 1, 1, 0),
                                (53, 'nl-NL', 'pages', 66, 1, 1, 0),
                                (54, 'nl-NL', 'pages', 89, 1, 1, 0),
                                (55, 'nl-NL', 'pages', 92, 1, 1, 0),
                                (56, 'nl-NL', 'pages', 93, 1, 1, 0),
                                (57, 'nl-NL', 'pages', 94, 1, 1, 0),
                                (58, 'nl-NL', 'pages', 95, 1, 1, 0),
                                (59, 'nl-NL', 'pages', 96, 1, 1, 0),
                                (60, 'nl-NL', 'pages', 97, 1, 1, 0),
                                (61, 'nl-NL', 'pages', 98, 1, 1, 0),
                                (62, 'nl-NL', 'pages', 99, 1, 1, 0),
                                (64, 'fr-FR', 'pages', 12, 3, 0, 0),
                                (65, 'fr-FR', 'pages', 16, 3, 0, 0),
                                (66, 'fr-FR', 'pages', 17, 3, 0, 0),
                                (67, 'fr-FR', 'pages', 31, 3, 0, 0),
                                (68, 'fr-FR', 'pages', 100, 3, 0, 0),
                                (69, 'fr-FR', 'pages', 101, 3, 0, 0),
                                (70, 'fr-FR', 'pages', 102, 3, 0, 0),
                                (71, 'fr-FR', 'pages', 103, 3, 0, 0),
                                (72, 'fr-FR', 'pages', 104, 3, 0, 0),
                                (73, 'fr-FR', 'pages', 105, 3, 0, 0),
                                (74, 'fr-FR', 'pages', 1, 3, 0, 0),
                                (75, 'fr-FR', 'pages', 2, 3, 0, 0),
                                (76, 'fr-FR', 'pages', 3, 3, 0, 0),
                                (77, 'fr-FR', 'pages', 4, 3, 0, 0),
                                (78, 'fr-FR', 'pages', 5, 3, 0, 0),
                                (79, 'fr-FR', 'pages', 6, 3, 0, 0),
                                (80, 'fr-FR', 'pages', 7, 3, 0, 0),
                                (81, 'fr-FR', 'pages', 8, 3, 0, 0),
                                (82, 'fr-FR', 'pages', 9, 3, 0, 0),
                                (83, 'fr-FR', 'pages', 10, 3, 0, 0),
                                (84, 'fr-FR', 'pages', 11, 3, 0, 0),
                                (85, 'fr-FR', 'pages', 14, 3, 0, 0),
                                (86, 'fr-FR', 'pages', 15, 3, 0, 0),
                                (87, 'fr-FR', 'pages', 20, 3, 0, 0),
                                (88, 'fr-FR', 'pages', 21, 3, 0, 0),
                                (89, 'fr-FR', 'pages', 22, 3, 0, 0),
                                (90, 'fr-FR', 'pages', 23, 3, 0, 0),
                                (91, 'fr-FR', 'pages', 24, 3, 0, 0),
                                (92, 'fr-FR', 'pages', 25, 3, 0, 0),
                                (93, 'fr-FR', 'pages', 26, 3, 0, 0),
                                (94, 'fr-FR', 'pages', 27, 3, 0, 0),
                                (95, 'fr-FR', 'pages', 28, 3, 0, 0),
                                (96, 'fr-FR', 'pages', 29, 3, 0, 0),
                                (97, 'fr-FR', 'pages', 30, 3, 0, 0),
                                (98, 'fr-FR', 'pages', 32, 3, 0, 0),
                                (99, 'fr-FR', 'pages', 33, 3, 0, 0),
                                (100, 'fr-FR', 'pages', 34, 3, 0, 0),
                                (101, 'fr-FR', 'pages', 36, 3, 0, 0),
                                (102, 'fr-FR', 'pages', 37, 3, 0, 0),
                                (103, 'fr-FR', 'pages', 39, 3, 0, 0),
                                (104, 'fr-FR', 'pages', 40, 3, 0, 0),
                                (105, 'fr-FR', 'pages', 41, 3, 0, 0),
                                (106, 'fr-FR', 'pages', 42, 3, 0, 0),
                                (107, 'fr-FR', 'pages', 43, 3, 0, 0),
                                (108, 'fr-FR', 'pages', 44, 3, 0, 0),
                                (109, 'fr-FR', 'pages', 45, 3, 0, 0),
                                (110, 'fr-FR', 'pages', 47, 3, 0, 0),
                                (111, 'fr-FR', 'pages', 53, 3, 0, 0),
                                (112, 'fr-FR', 'pages', 54, 3, 0, 0),
                                (113, 'fr-FR', 'pages', 55, 3, 0, 0),
                                (114, 'fr-FR', 'pages', 56, 3, 0, 0),
                                (115, 'fr-FR', 'pages', 57, 3, 0, 0),
                                (116, 'fr-FR', 'pages', 66, 3, 0, 0),
                                (117, 'fr-FR', 'pages', 89, 3, 0, 0),
                                (118, 'fr-FR', 'pages', 92, 3, 0, 0),
                                (119, 'fr-FR', 'pages', 93, 3, 0, 0),
                                (120, 'fr-FR', 'pages', 94, 3, 0, 0),
                                (121, 'fr-FR', 'pages', 95, 3, 0, 0),
                                (122, 'fr-FR', 'pages', 96, 3, 0, 0),
                                (123, 'fr-FR', 'pages', 97, 3, 0, 0),
                                (124, 'fr-FR', 'pages', 98, 3, 0, 0),
                                (125, 'fr-FR', 'pages', 99, 3, 0, 0);";

        parent::up();

        // Target `data` database
        $this->getZones()->reset()->set(array('data' => 'data'));

        // Make zone names multilingual
        $this->_queries = "ALTER TABLE `police_zones` CHANGE `title` `title_nl` VARCHAR(250)  NOT NULL  DEFAULT '';";
        $this->_queries .= "ALTER TABLE `police_zones` ADD `title_fr` VARCHAR(250)  NOT NULL  DEFAULT '' AFTER `title_nl`;";
        $this->_queries .= "UPDATE `police_zones` SET `title_fr` = `title_nl` WHERE `language` = '2';";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "UPDATE `pages` SET `title` = 'Components', `slug` = 'components', `link_url` = 'option=com_languages&view=components' WHERE `pages_page_id` = '23';";
        $this->_queries .= "UPDATE `pages_closures` SET `ancestor_id` = '4' WHERE `ancestor_id` = '9' AND `descendant_id` IN ('15', '22', '23') AND `level` = '1';";
        $this->_queries .= "UPDATE `pages_orderings` SET `custom` = '00000000009' WHERE `pages_page_id` IN ('15');";

        // Move about_categories to categories
        $this->_queries .= "ALTER TABLE `about` CHANGE `about_category_id` `categories_category_id` INT(11)  NOT NULL  DEFAULT '0';";
        $this->_queries .= "ALTER TABLE `about_categories` CHANGE `about_category_id` `categories_category_id` INT(11)  NOT NULL  AUTO_INCREMENT;";
        $this->_queries .= "ALTER TABLE `about_categories` ADD `table` VARCHAR(250)  NOT NULL  DEFAULT ''  AFTER `image`;";
        $this->_queries .= "INSERT `categories` SELECT * FROM `about_categories`;";
        $this->_queries .= "UPDATE `categories` SET `table` = 'about' WHERE `table` = '';";
        $this->_queries .= "DROP TABLE IF EXISTS `about_categories`;";

        // Move contacts_categories to categories
        $this->_queries .= "ALTER TABLE `contacts` CHANGE `contacts_category_id` `categories_category_id` INT(11)  NOT NULL  DEFAULT '0';";
        $this->_queries .= "ALTER TABLE `contacts_categories` CHANGE `contacts_category_id` `categories_category_id` INT(11)  NOT NULL  AUTO_INCREMENT;";
        $this->_queries .= "ALTER TABLE `contacts_categories` ADD `table` VARCHAR(250)  NOT NULL  DEFAULT ''  AFTER `image`;";
        $this->_queries .= "INSERT `categories` SELECT * FROM `contacts_categories`;";
        $this->_queries .= "UPDATE `categories` SET `table` = 'contacts' WHERE `table` = '';";
        $this->_queries .= "DROP TABLE IF EXISTS `contacts_categories`;";

        $this->_queries .= "UPDATE `categories` SET `table` = 'bin' WHERE `slug` IN ('buurt-informatie-netwerk', 'reseau-information-de-quartier') AND `table` = 'contacts';";
        $this->_queries .= "UPDATE `categories` SET `table` = 'districts' WHERE `slug` IN ('je-wijkinspecteur', 'votre-agent-de-quartier') AND `table` = 'contacts';";

        // Move traffic_categories to categories
        $this->_queries .= "ALTER TABLE `traffic` CHANGE `traffic_category_id` `categories_category_id` INT(11)  NOT NULL  DEFAULT '0';";
        $this->_queries .= "ALTER TABLE `traffic_categories` CHANGE `traffic_category_id` `categories_category_id` INT(11)  NOT NULL  AUTO_INCREMENT;";
        $this->_queries .= "ALTER TABLE `traffic_categories` ADD `table` VARCHAR(250)  NOT NULL  DEFAULT ''  AFTER `image`;";
        $this->_queries .= "INSERT `categories` SELECT * FROM `traffic_categories`;";
        $this->_queries .= "UPDATE `categories` SET `table` = 'traffic' WHERE `table` = '';";
        $this->_queries .= "DROP TABLE IF EXISTS `traffic_categories`;";

        // Move questions_categories to categories
        $this->_queries .= "ALTER TABLE `questions` CHANGE `questions_category_id` `categories_category_id` INT(11)  NOT NULL  DEFAULT '0';";
        $this->_queries .= "ALTER TABLE `questions_categories` CHANGE `questions_category_id` `categories_category_id` INT(11)  NOT NULL  AUTO_INCREMENT;";
        $this->_queries .= "ALTER TABLE `questions_categories` ADD `table` VARCHAR(250)  NOT NULL  DEFAULT ''  AFTER `image`;";
        $this->_queries .= "INSERT `categories` SELECT * FROM `questions_categories`;";
        $this->_queries .= "UPDATE `categories` SET `table` = 'questions' WHERE `table` = '';";
        $this->_queries .= "DROP TABLE IF EXISTS `questions_categories`;";

        $this->_queries .= "DELETE FROM `languages`;";
        $this->_queries .= "INSERT INTO `languages` (`languages_language_id`, `application`, `name`, `native_name`, `iso_code`, `slug`, `enabled`, `primary`)
                            VALUES
                                (1, 'admin', 'English (United Kingdom)', 'English (United Kingdom)', 'en-GB', 'en', 1, 1),
                                (2, 'site', 'English (United Kingdom)', 'English (United Kingdom)', 'en-GB', 'en', 1, 1);";

        $this->_queries .= "DELETE FROM `languages_tables`;";
        $this->_queries .= "DELETE FROM `languages_translations`;";

        parent::down();


        // All the multilingual zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "UPDATE `pages` SET `published` = '0' WHERE `pages_page_id` IN ('15', '22', '23');";
        $this->_queries .= "DROP TABLE IF EXISTS `fr-fr_pages`;";

        parent::down();

        // Target `data` database
        $this->getZones()->reset()->set(array('data' => 'data'));

        // Restore zones names to one language
        $this->_queries = "ALTER TABLE `police_zones` CHANGE `title_nl` `title` VARCHAR(250)  NOT NULL  DEFAULT '';";
        $this->_queries .= "ALTER TABLE `police_zones` DROP `title_fr`;";

        parent::down();
    }
}
