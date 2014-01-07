<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Timble CVBA and Contributors. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git
 */

namespace Nooku\Component\Fora;
use Nooku\Library;

/**
 *  Users Database Topics
 *
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser
 * @package Nooku\Component\Fora
 */
class DatabaseTableUsers extends Library\DatabaseTableAbstract
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'name'       => 'data.fora_users',
        ));

        parent::_initialize($config);
    }
}