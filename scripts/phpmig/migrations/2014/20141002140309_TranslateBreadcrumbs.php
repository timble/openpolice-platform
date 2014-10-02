<?php

use MyPhpmig\Police\Migration;

class TranslateBreadcrumbs extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->getZones()->reset()->where('language', '=', 2);

        $this->_queries = "UPDATE `pages_modules` SET `params` = 'showHome=1\nhomeText=Accueil\nshowLast=1' WHERE `pages_module_id` = '4';";

        parent::up();

        // All the multilingual zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "UPDATE `fr-fr_pages_modules` SET `params` = 'showHome=1\nhomeText=Accueil\nshowLast=1' WHERE `pages_module_id` = '4';";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->getZones()->reset()->where('language', '=', 2);

        $this->_queries = "UPDATE `pages_modules` SET `params` = 'showHome=1\nhomeText=Home\nshowLast=1' WHERE `pages_module_id` = '4';";

        parent::down();

        // All the multilingual zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "UPDATE `fr-fr_pages_modules` SET `params` = 'showHome=1\nhomeText=Home\nshowLast=1' WHERE `pages_module_id` = '4';";

        parent::down();
    }
}
