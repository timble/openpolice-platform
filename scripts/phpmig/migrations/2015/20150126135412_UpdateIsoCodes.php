<?php

use MyPhpmig\Police\Migration;

class UpdateIsoCodes extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "UPDATE `languages` SET `iso_code` = 'nl-be' WHERE `slug` = 'nl';";
        $this->_queries .= "UPDATE `languages` SET `iso_code` = 'fr-be' WHERE `slug` = 'fr';";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "UPDATE `languages` SET `iso_code` = 'nl-NL' WHERE `slug` = 'nl';";
        $this->_queries .= "UPDATE `languages` SET `iso_code` = 'fr-FR' WHERE `slug` = 'fr';";

        parent::down();
    }
}
