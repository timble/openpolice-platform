<?php

use MyPhpmig\Police\Migration;

class Cleanup extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "";
        $this->_queries .= "ALTER TABLE `about` DROP `access`;";
        $this->_queries .= "ALTER TABLE `about` DROP `description`;";
        $this->_queries .= "ALTER TABLE `about` DROP `publish_on`;";
        $this->_queries .= "ALTER TABLE `about` DROP `unpublish_on`;";

        $this->_queries .= "ALTER TABLE `about_categories` DROP `image`;";
        $this->_queries .= "ALTER TABLE `about_categories` DROP `access`;";

        $this->_queries .= "ALTER TABLE `contacts` DROP `access`;";

        $this->_queries .= "ALTER TABLE `contacts_categories` DROP `access`;";
        $this->_queries .= "ALTER TABLE `contacts_categories` DROP `image`;";

        $this->_queries .= "ALTER TABLE `questions` DROP `ordering`;";

        $this->_queries .= "ALTER TABLE `questions_categories` DROP `ordering`;";
        $this->_queries .= "ALTER TABLE `questions_categories` DROP `access`;";
        $this->_queries .= "ALTER TABLE `questions_categories` DROP `image`;";

        $this->_queries .= "ALTER TABLE `traffic_categories` DROP `access`;";
        $this->_queries .= "ALTER TABLE `traffic_categories` DROP `ordering`;";
        $this->_queries .= "ALTER TABLE `traffic_categories` DROP `image`;";

        parent::up();


        // All multilingual zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "";
        $this->_queries .= "ALTER TABLE `fr-be_about` DROP `access`;";
        $this->_queries .= "ALTER TABLE `fr-be_about` DROP `description`;";
        $this->_queries .= "ALTER TABLE `fr-be_about` DROP `publish_on`;";
        $this->_queries .= "ALTER TABLE `fr-be_about` DROP `unpublish_on`;";

        $this->_queries .= "ALTER TABLE `fr-be_about_categories` DROP `image`;";
        $this->_queries .= "ALTER TABLE `fr-be_about_categories` DROP `access`;";

        $this->_queries .= "ALTER TABLE `fr-be_contacts` DROP `access`;";

        $this->_queries .= "ALTER TABLE `fr-be_contacts_categories` DROP `access`;";
        $this->_queries .= "ALTER TABLE `fr-be_contacts_categories` DROP `image`;";

        $this->_queries .= "ALTER TABLE `fr-be_questions` DROP `ordering`;";

        $this->_queries .= "ALTER TABLE `fr-be_questions_categories` DROP `ordering`;";
        $this->_queries .= "ALTER TABLE `fr-be_questions_categories` DROP `access`;";
        $this->_queries .= "ALTER TABLE `fr-be_questions_categories` DROP `image`;";

        $this->_queries .= "ALTER TABLE `fr-be_traffic_categories` DROP `access`;";
        $this->_queries .= "ALTER TABLE `fr-be_traffic_categories` DROP `ordering`;";
        $this->_queries .= "ALTER TABLE `fr-be_traffic_categories` DROP `image`;";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "SELECT 1;";

        parent::down();
    }
}
