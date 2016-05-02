<?php

use MyPhpmig\Police\Migration;

class AddOfficeHourExceptions extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries .= "ALTER TABLE `contacts_hours` ADD `date` DATE  NULL  AFTER `day_of_week`;";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries .= "ALTER TABLE `contacts_hours` DROP `date`;";

        parent::down();
    }
}
