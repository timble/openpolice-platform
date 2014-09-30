<?php

use MyPhpmig\Police\Migration;

class AddHiddenCategories extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "ALTER TABLE `contacts_categories` ADD `hidden` TINYINT(1)  NOT NULL  DEFAULT '0'  AFTER `published`;";
        $this->_queries = "UPDATE `contacts_categories` SET `hidden` = '1' WHERE `contacts_category_id` IN ('24', '34');";

        parent::up();

        // All the multilingual zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "ALTER TABLE `fr-fr_contacts_categories` ADD `hidden` TINYINT(1)  NOT NULL  DEFAULT '0'  AFTER `published`;";
        $this->_queries = "UPDATE `fr-fr_contacts_categories` SET `hidden` = '1' WHERE `contacts_category_id` IN ('24', '34');";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_query = "ALTER TABLE `contacts_categories` DROP `hidden`;";

        parent::down();

        // All the multilingual zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "ALTER TABLE `fr-fr_contacts_categories` DROP `hidden`;";

        parent::down();
    }
}
