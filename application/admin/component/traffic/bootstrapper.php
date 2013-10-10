<?php
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class TrafficBootstrapper extends Library\BootstrapperAbstract
{
    public function bootstrap()
    {
        $manager = $this->getObjectManager();

        $manager->registerAlias('com:traffic.model.categories', 'com:categories.model.categories');
        $manager->registerAlias('com:traffic.controller.attachment', 'com:attachments.controller.attachment');

        // DatabaseBehaviorCascadable in Categories is looking for a database table that matches the package name
        $manager->registerAlias('com:traffic.database.table.traffic', 'com:traffic.database.table.articles');
    }
}