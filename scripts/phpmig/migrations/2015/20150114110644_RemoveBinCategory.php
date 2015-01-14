<?php

use MyPhpmig\Police\Migration;

class RemoveBinCategory extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "DELETE FROM `contacts_categories` WHERE `slug` IN ('buurt-informatie-netwerk', 'reseau-information-de-quartier');";
        $this->_queries .= "DELETE FROM `pages` WHERE `slug` IN ('buurt-informatie-netwerk', 'reseau-information-de-quartier');";

        parent::up();

        // All the Multilingual speaking zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "DELETE FROM `fr-fr_contacts_categories` WHERE `slug` IN ('buurt-informatie-netwerk', 'reseau-information-de-quartier');";
        $this->_queries .= "DELETE FROM `fr-fr_pages` WHERE `slug` IN ('buurt-informatie-netwerk', 'reseau-information-de-quartier');";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {

        $this->_queries = "SELECT 1;";

        parent::up();
    }
}
