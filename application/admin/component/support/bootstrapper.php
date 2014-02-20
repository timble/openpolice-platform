<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2014 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class SupportBootstrapper extends Library\BootstrapperAbstract
{
    /**
     * Bootstrap the component
     *
     * @return void
     */
    public function bootstrap()
    {
        $this->getClassLoader()
            ->getLocator('psr')
            ->registerNamespace('rcrowe\\Hippy', JPATH_VENDOR.'/rcrowe/hippy/src')
            ->registerNamespace('Guzzle', JPATH_VENDOR.'/guzzle/guzzle/src')
            ->registerNamespace('Symfony\\Component\\EventDispatcher\\', JPATH_VENDOR.'/symfony/event-dispatcher');

        $manager = $this->getObjectManager();
        $manager->registerAlias('com:support.view.attachment.file', 'com:attachments.view.attachment.file');
    }
}