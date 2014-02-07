<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Timble CVBA and Contributors. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git
 */

use Nooku\Library;

/**
 *  Statuses Database Rowset
 *
 * @author  Tom Janssens <http://nooku.assembla.com/profile/tomjanssens
 * @package Nooku\Component\Support
 */
class SupportDatabaseRowsetStatuses extends Library\DatabaseRowsetAbstract
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'identity_column'   => 'text'
        ));

        parent::_initialize($config);
    }
}