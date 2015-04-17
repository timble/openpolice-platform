<?php

use MyPhpmig\Police\Migration;

class AddLoginAttempts extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = <<<EOL
ALTER TABLE `users` ADD `login_attempts` INT  NULL  DEFAULT NULL  AFTER `send_email`;";

UPDATE `extensions` SET `params` = 'allowUserRegistration=\"1\"\nnew_usertype=\"18\"\nuseractivation=\"1\"\nfrontend_userparams=\"1\"\npassword_length=\"5\"\npassword_expire=\"0\"\nrecaptcha_public_key=\"\"\nrecaptcha_private_key=\"\"\nmaximum_login_attempts=5' WHERE `extensions_extension_id` = '31';

EOL;

        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = <<<EOL
ALTER TABLE `users` DROP `login_attempts`;

UPDATE `extensions` SET `params` = 'allowUserRegistration=\"1\"\nnew_usertype=\"18\"\nuseractivation=\"1\"\nfrontend_userparams=\"1\"\npassword_length=\"5\"\npassword_expire=\"0\"\nrecaptcha_public_key=\"\"\nrecaptcha_private_key=\"\"' WHERE `extensions_extension_id` = '31';

EOL;

        parent::down();
    }
}
