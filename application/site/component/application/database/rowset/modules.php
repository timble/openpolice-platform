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
 * Modules Database Rowset
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Application
 */
class ApplicationDatabaseRowsetModules extends Library\DatabaseRowsetAbstract implements Library\ObjectMultiton
{
    public function __construct(Library\ObjectConfig $config )
    {
        parent::__construct($config);

        //TODO : Inject raw data using $config->data
        $page = $this->getObject('application.pages')->getActive();

        $modules = $this->getObject('com:pages.model.modules')
            ->application('site')
            ->published(true)
            ->access((int) $this->getObject('user')->isAuthentic())
            ->page($page->id)
            ->getRowset();

        $this->merge($modules);
    }

    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->identity_column = 'id';
        parent::_initialize($config);
    }
}