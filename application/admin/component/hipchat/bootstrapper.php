<?php
/**
 * Belgian Police Web Platform - HipChat Component
 *
 * @copyright	Copyright (C) 2012 - 2014 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class HipchatBootstrapper extends Library\BootstrapperAbstract
{
    public function bootstrap()
    {
        $this->getClassLoader()
            ->getLocator('psr')
            ->registerNamespace('rcrowe\\Hippy', JPATH_VENDOR.'/rcrowe/hippy/src')
            ->registerNamespace('Guzzle', JPATH_VENDOR.'/guzzle/guzzle/src')
            ->registerNamespace('Symfony\\Component\\EventDispatcher\\', JPATH_VENDOR.'/symfony/event-dispatcher');
    }
}
