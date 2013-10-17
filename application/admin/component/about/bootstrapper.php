<?php
/**
 * Belgian Police Web Platform - About Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class AboutBootstrapper extends Library\BootstrapperAbstract
{
    public function bootstrap()
    {
        $manager = $this->getObjectManager();

        $manager->registerAlias('com:about.model.categories', 'com:categories.model.categories');

        // DatabaseBehaviorCascadable in Categories is looking for a database table that matches the package name
        $manager->registerAlias('com:about.database.table.about', 'com:about.database.table.articles');
    }
}