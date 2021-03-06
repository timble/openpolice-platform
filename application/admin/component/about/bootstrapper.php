<?php
/**
 * Belgian Police Web Platform - About Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class AboutBootstrapper extends Library\BootstrapperAbstract
{
    public function bootstrap()
    {
        $manager = $this->getObjectManager();

        $manager->registerAlias('com:about.view.attachment.file', 'com:attachments.view.attachment.file');
        $manager->registerAlias('com:about.controller.attachment', 'com:articles.controller.attachment');

        // DatabaseBehaviorCascadable in Categories is looking for a database table that matches the package name
        $manager->registerAlias('com:about.database.table.about', 'com:about.database.table.articles');
    }
}