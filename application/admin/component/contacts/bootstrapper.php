<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

/**
 * Bootstrapper
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Contacts
 */
 class ContactsBootstrapper extends Library\BootstrapperAbstract
{
    /**
     * Bootstrap the component
     *
     * @return void
     */
    public function bootstrap()
    {
        $manager = $this->getObjectManager();

        $manager->registerAlias('com:contacts.controller.attachment', 'com:attachments.controller.attachment');
    }
}