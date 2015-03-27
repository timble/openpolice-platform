<?php

use MyPhpmig\Police\Migration;

class RenameNouvelles extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        // All French zones.
        $this->getZones()->reset()->where('language', '=', 2);

        $this->_queries = "UPDATE `pages` SET `title` = 'Actualités', `slug` = 'actualites' WHERE `title` = 'Nouvelles';";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Actualités' WHERE `title` = 'Nouvelles';";

        parent::up();

        // All multilingual zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "UPDATE `fr-be_pages` SET `title` = 'Actualités', `slug` = 'actualites' WHERE `title` = 'Nouvelles';";
        $this->_queries .= "UPDATE `fr-be_pages` SET `title` = 'Actualités' WHERE `title` = 'Nouvelles';";
        $this->_queries .= "UPDATE `languages_translations` SET `slug` = 'actualites' WHERE `slug` = 'nouvelles' AND `table` = 'pages';";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        // All French zones.
        $this->getZones()->reset()->where('language', '=', 2);

        $this->_queries = "UPDATE `pages` SET `title` = 'Nouvelles', `slug` = 'actualites' WHERE `title` = 'Actualités';";
        $this->_queries .= "UPDATE `pages` SET `title` = 'Nouvelles' WHERE `title` = 'Actualités';";

        parent::up();

        // All multilingual zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "UPDATE `fr-be_pages` SET `title` = 'Nouvelles', `slug` = 'nouvelles' WHERE `title` = 'Actualités';";
        $this->_queries .= "UPDATE `fr-be_pages` SET `title` = 'Nouvelles' WHERE `title` = 'Actualités';";
        $this->_queries .= "UPDATE `languages_translations` SET `slug` = 'nouvelles' WHERE `slug` = 'actualites' AND `table` = 'pages';";

        parent::up();
    }
}
