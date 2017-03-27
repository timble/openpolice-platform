<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;
use Nooku\Component\Pages;

/**
 * Pages Database Rowset
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Application
 */
class ApplicationDatabaseRowsetPages extends Pages\DatabaseRowsetPages implements Library\ObjectMultiton
{
    public function __construct(Library\ObjectConfig $config )
    {
        parent::__construct($config);

        //TODO : Inject raw data using $config->data
        $pages = $this->getObject('com:pages.model.pages')
            ->application('manager')
            ->published(true)
            ->getRowset();

        $this->merge($pages);
    }

    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->identity_column = 'id';
        parent::_initialize($config);
    }

    public function getPage($id)
    {
        $page = $this->find($id);
        return $page;
    }
}