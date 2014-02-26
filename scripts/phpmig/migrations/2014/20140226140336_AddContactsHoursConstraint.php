<?php

use MyPhpmig\Police\Migration;

class AddContactsHoursConstraint extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "ALTER TABLE `contacts_hours` ADD CONSTRAINT `contacts_hours__contacts_contact_id` FOREIGN KEY (`contacts_contact_id`) REFERENCES `contacts` (`contacts_contact_id`) ON DELETE CASCADE;";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "ALTER TABLE `contacts_hours` DROP FOREIGN KEY `contacts_hours__contacts_contact_id`;
                            ALTER TABLE `contacts_hours` DROP INDEX  `contacts_hours__contacts_contact_id`;";

        parent::down();
    }
}
