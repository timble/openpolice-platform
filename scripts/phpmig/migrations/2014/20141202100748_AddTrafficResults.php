<?php

use MyPhpmig\Police\Migration;

class AddTrafficResults extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "UPDATE `pages` AS `a`, `pages` AS `b`  SET `a`.`published` = `b`.`published` WHERE `a`.`pages_page_id` = '114' AND `b`.`pages_page_id` = '110';";

        parent::up();

        // All the Multilingual speaking zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "UPDATE `fr-fr_pages` AS `a`, `pages` AS `b`  SET `a`.`published` = `b`.`published` WHERE `a`.`pages_page_id` = '114' AND `b`.`pages_page_id` = '110';";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "UPDATE `pages` SET `published` = '1' WHERE `pages_page_id` = '114';";

        parent::down();

        // All the Multilingual speaking zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "UPDATE `fr-fr_pages` SET `published` = '1' WHERE `pages_page_id` = '114';";

        parent::down();
    }
}
