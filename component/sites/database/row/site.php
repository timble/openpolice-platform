<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Sites;

use Nooku\Library;

/**
 * Site Database Row
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Sites
 */
class DatabaseRowSite extends Library\DatabaseRowAbstract
{       
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'identity_column'   => 'name'
        ));

        parent::_initialize($config);
    }
}