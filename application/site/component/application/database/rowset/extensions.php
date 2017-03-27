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
 * Components Database Rowset
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Application
 */
class ApplicationDatabaseRowsetExtensions extends Library\DatabaseRowsetAbstract implements Library\ObjectMultiton
{
    public function __construct(Library\ObjectConfig $config )
    {
        parent::__construct($config);

        //TODO : Inject raw data using $config->data
        $extensions = $this->getObject('com:extensions.model.extensions')
            ->enabled(true)
            ->getRowset();

        $this->merge($extensions);
    }

    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->identity_column = 'name';
        parent::_initialize($config);
    }

    public function getExtension($name)
    {
        $extension = $this->find('com_'.$name);
        return $extension;
    }

    public function isEnabled($name)
    {
        $result = false;
        if($extension = $this->find('com_'.$name)) {
            $result = (bool) $extension->enabled;
        }

        return $result;
    }

    public function __get($name)
    {
        return $this->getExtension($name);
    }
}