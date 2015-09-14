<?php

use MyPhpmig\Police\Migration;

class RenameUrgence extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        // All the French speaking zones.
        $this->getZones()->reset()->where('language', '=', 2);

        $this->_queries = "UPDATE `pages` SET `title` = 'Numéros d\'urgence' WHERE `pages_page_id` = '66';";
        $this->_queries .= "UPDATE `pages` SET `slug` = 'numeros-durgence' WHERE `pages_page_id` = '66';";
        $this->_queries .= "UPDATE `contacts_categories` SET `title` = 'Numéros d\'urgence' WHERE `contacts_category_id` = '18';";

        parent::up();

        // All the Multilingual speaking zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "UPDATE `fr-be_pages` SET `title` = 'Numéros d\'urgence' WHERE `pages_page_id` = '66';";
        $this->_queries .= "UPDATE `fr-be_pages` SET `slug` = 'numeros-durgence' WHERE `pages_page_id` = '66';";
        $this->_queries .= "UPDATE `fr-be_contacts_categories` SET `title` = 'Numéros d\'urgence' WHERE `contacts_category_id` = '18';";

        parent::up();

        // All the Multilingual speaking zones.
        $this->getZones()->reset()->where('language', '=', 7);

        $this->_queries = "UPDATE `fr-be_pages` SET `title` = 'Numéros d\'urgence' WHERE `pages_page_id` = '66';";
        $this->_queries .= "UPDATE `fr-be_pages` SET `slug` = 'numeros-durgence' WHERE `pages_page_id` = '66';";
        $this->_queries .= "UPDATE `fr-be_contacts_categories` SET `title` = 'Numéros d\'urgence' WHERE `contacts_category_id` = '18';";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {

        // All the French speaking zones.
        $this->getZones()->reset()->where('language', '=', 2);

        $this->_queries = "UPDATE `pages` SET `title` = 'Des numéros d\'urgence' WHERE `pages_page_id` = '66';";
        $this->_queries .= "UPDATE `pages` SET `slug` = 'des-numeros-durgence' WHERE `pages_page_id` = '66';";
        $this->_queries .= "UPDATE `contacts_categories` SET `title` = 'Des numéros d\'urgence' WHERE `contacts_category_id` = '18';";

        parent::down();

        // All the Multilingual speaking zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "UPDATE `fr-be_pages` SET `title` = 'Des numéros d\'urgence' WHERE `pages_page_id` = '66';";
        $this->_queries .= "UPDATE `fr-be_pages` SET `slug` = 'des-numeros-durgence' WHERE `pages_page_id` = '66';";
        $this->_queries .= "UPDATE `fr-be_contacts_categories` SET `title` = 'Des numéros d\'urgence' WHERE `contacts_category_id` = '18';";

        parent::down();

        // All the Multilingual speaking zones.
        $this->getZones()->reset()->where('language', '=', 7);

        $this->_queries = "UPDATE `fr-be_pages` SET `title` = 'Des numéros d\'urgence' WHERE `pages_page_id` = '66';";
        $this->_queries .= "UPDATE `fr-be_pages` SET `slug` = 'des-numeros-durgence' WHERE `pages_page_id` = '66';";
        $this->_queries .= "UPDATE `fr-be_contacts_categories` SET `title` = 'Des numéros d\'urgence' WHERE `contacts_category_id` = '18';";

        parent::down();
    }
}
