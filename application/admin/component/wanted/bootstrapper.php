<?php
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class WantedBootstrapper extends Library\BootstrapperAbstract
{
    public function bootstrap()
    {
        $manager = $this->getObjectManager();

        $manager->registerAlias('com:wanted.view.attachment.file', 'com:attachments.view.attachment.file');
        $manager->registerAlias('com:wanted.controller.attachment', 'com:articles.controller.attachment');
    }
}