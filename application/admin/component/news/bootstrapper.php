<?php
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class NewsBootstrapper extends Library\BootstrapperAbstract
{
    public function bootstrap()
    {
        $manager = $this->getObjectManager();

        $manager->registerAlias('com:news.model.categories', 'com:categories.model.categories');
        $manager->registerAlias('com:news.view.attachment.file', 'com:attachments.view.attachment.file');
        $manager->registerAlias('com:news.controller.attachment', 'com:attachments.controller.attachment');
    }
}