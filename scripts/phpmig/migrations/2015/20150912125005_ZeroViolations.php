<?php

use MyPhpmig\Police\Migration;

class ZeroViolations extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {

        $this->_queries = "ALTER TABLE `traffic` CHANGE `in_violation` `in_violation` INT(11) NOT NULL;";

        // All the Multilingual speaking zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "ALTER TABLE `be-fr_traffic` CHANGE `in_violation` `in_violation` INT(11) NOT NULL;";

        // All the Multilingual speaking zones.
        $this->getZones()->reset()->where('language', '=', 7);

        $this->_queries = "ALTER TABLE `be-de_traffic` CHANGE `in_violation` `in_violation` INT(11) NOT NULL;";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {

        $this->_queries = "ALTER TABLE `traffic` CHANGE `in_violation` `in_violation` INT(11) NULL;";

        // All the Multilingual speaking zones.
        $this->getZones()->reset()->where('language', '=', 3);

        $this->_queries = "ALTER TABLE `be-fr_traffic` CHANGE `in_violation` `in_violation` INT(11) NULL;";

        // All the Multilingual speaking zones.
        $this->getZones()->reset()->where('language', '=', 7);

        $this->_queries = "ALTER TABLE `be-de_traffic` CHANGE `in_violation` `in_violation` INT(11) NULL;";

        parent::up();
    }
}
