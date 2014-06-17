<?php

use MyPhpmig\Police\Migration;

class RemoveColumnInDistrictsOfficers extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "ALTER TABLE `districts_officers` DROP `attachments_attachment_id`";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "ALTER TABLE `districts_relations` ADD `attachments_attachment_id` INT  UNSIGNED  NULL  DEFAULT NULL  AFTER `districts_officer_id`;";

        parent::down();
    }
}
