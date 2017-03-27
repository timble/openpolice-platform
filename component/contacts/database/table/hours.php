<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Contacts;

use Nooku\Library;

/**
 * Hours Database Table
 *
 * @author  Tom Janssens <http://nooku.assembla.com/profile/tomjanssens>
 * @package Nooku\Component\Contacts
 */
class DatabaseTableHours extends Library\DatabaseTableAbstract
{
    protected function _initialize(Library\ObjectConfig $config)
    {        
        $config->append(array(
            'behaviors' => array(
                'creatable', 'modifiable', 'lockable'
            )
        ));
     
        parent::_initialize($config);
     }
}