<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2014 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Support;

use Nooku\Library;

class DatabaseRowsetStatuses extends Library\DatabaseRowsetAbstract
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'identity_column'   => 'text'
        ));

        parent::_initialize($config);
    }
}