<?php

use MyPhpmig\Police\Migration;

class AddLoginAttempts extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = "ALTER TABLE `users` ADD `login_attempts` INT  NULL  DEFAULT NULL  AFTER `send_email`;";

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = "ALTER TABLE `users` DROP `login_attempts`;";

        parent::down();
    }
}
