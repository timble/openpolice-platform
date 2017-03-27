<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Sites;

use Nooku\Library;

/**
 * Site Database Rowset
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Sites
 */
class DatabaseRowsetSites extends Library\DatabaseRowsetAbstract
{       
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'identity_column'   => 'name'
        ));
        
        parent::_initialize($config);
    }
}