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
        $this->_queries .= "INSERT INTO `languages_tables` (`languages_table_id`, `extensions_extension_id`, `name`, `unique_column`, `enabled`)
                            VALUES
                                (1, 25, 'pages', 'pages_page_id', 0),
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

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "UPDATE `pages` SET `title` = 'Components', `slug` = 'components', `link_url` = 'option=com_languages&view=components' WHERE `pages_page_id` = '23';";

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

        $this->_queries .= "DELETE FROM `languages_tables`;";

        $this->_queries .= "DELETE FROM `languages`;";
        $this->_queries .= "INSERT INTO `languages` (`languages_language_id`, `application`, `name`, `native_name`, `iso_code`, `slug`, `enabled`, `primary`)
                            VALUES
                                (1, 'admin', 'English (United Kingdom)', 'English (United Kingdom)', 'en-GB', 'en', 1, 1),
                                (2, 'site', 'English (United Kingdom)', 'English (United Kingdom)', 'en-GB', 'en', 1, 1);
                            ";

        parent::down();


        // All the multilingual zones.
        $this->getZones()->where('language', '=', 3);

        $this->_queries = "UPDATE `pages` SET `published` = '0' WHERE `pages_page_id` IN ('15', '22', '23');";

        parent::down();
    }
}
