<?php

use MyPhpmig\Police\Migration;

class AddLoginAttempts extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->getZones()->append(array('manager' => 'Manager'));

        $this->_queries = <<<EOL
ALTER TABLE `users` ADD `login_attempts` INT NOT NULL  DEFAULT 0 AFTER `send_email`;
ALTER TABLE `users` ADD `last_login_attempt` DATETIME NULL  DEFAULT NULL  AFTER `login_attempts`;

UPDATE `extensions` SET `params` = 'allowUserRegistration=\"0\"\nnew_usertype=\"18\"\nuseractivation=\"1\"\nfrontend_userparams=\"1\"\npassword_length=\"5\"\npassword_expire=\"0\"\nrecaptcha_public_key=\"\"\nrecaptcha_private_key=\"\"\nmaximum_login_attempts=5\nlockout_time=900' WHERE `name` = 'com_users';
EOL;

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->getZones()->append(array('manager' => 'Manager'));

        $this->_queries = <<<EOL
ALTER TABLE `users` DROP `login_attempts`;
ALTER TABLE `users` DROP `last_login_attempt`;

UPDATE `extensions` SET `params` = 'allowUserRegistration=\"1\"\nnew_usertype=\"18\"\nuseractivation=\"1\"\nfrontend_userparams=\"1\"\npassword_length=\"5\"\npassword_expire=\"0\"\nrecaptcha_public_key=\"\"\nrecaptcha_private_key=\"\"' WHERE `name` = 'com_users';
EOL;

        parent::down();
    }
}
