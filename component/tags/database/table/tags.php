<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Tags;

use Nooku\Library;

/**
 * Tags Database Table
 *   
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Tags
 */
class DatabaseTableTags extends Library\DatabaseTableAbstract
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'name'       => 'tags',
            'behaviors'  => array(
                'creatable', 'modifiable', 'lockable', 'sluggable'
            )
        ));

        parent::_initialize($config);
    }
}