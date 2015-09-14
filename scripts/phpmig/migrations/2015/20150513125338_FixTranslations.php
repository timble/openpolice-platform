<?php

use MyPhpmig\Police\Migration;

class FixTranslations extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "UPDATE `pages` SET `slug` = 'objets-trouves' WHERE `slug` = 'objects-trouves' AND `pages_page_id` = '116';";
        $this->_queries .= "ALTER TABLE `found` CHANGE `tracking_number` `tracking_number` VARCHAR(250)  CHARACTER SET utf8  NULL  DEFAULT NULL;";

        parent::up();

        // All multilingual zones and Federal
        $this->getZones()->reset()->where('language', '>=', 3);

        $this->_queries = "UPDATE `fr-be_pages` SET `slug` = 'objets-trouves' WHERE `pages_page_id` = 'objects-trouves' AND `pages_page_id` = '116';";
        $this->_queries .= "UPDATE `languages_translations` SET `slug` = 'objets-trouves' WHERE `slug` = 'objects-trouves' AND `row` = '116';";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "UPDATE `pages` SET `slug` = 'objects-trouves' WHERE `slug` = 'objets-trouves' AND `pages_page_id` = '116';";
        $this->_queries .= "ALTER TABLE `found` CHANGE `tracking_number` `tracking_number` INT(11)  CHARACTER SET utf8  NULL  DEFAULT NULL;";

        parent::down();

        // All multilingual zones and Federal
        $this->getZones()->reset()->where('language', '>=', 3);

        $this->_queries = "UPDATE `fr-be_pages` SET `slug` = 'objects-trouves' WHERE `slug` = 'objets-trouves' AND `pages_page_id` = '116';";
        $this->_queries .= "UPDATE `languages_translations` SET `slug` = 'objects-trouves' WHERE `slug` = 'objets-trouves' AND `row` = '116';";

        parent::down();
    }
}
