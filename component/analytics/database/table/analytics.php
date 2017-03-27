<?php
/**
 * Belgian Police Web Platform - Analytics Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Analytics;
use Nooku\Library;

class DatabaseTableAnalytics extends Library\DatabaseTableAbstract
{
    public function  _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'name'      => 'data.analytics'
        ));

        parent::_initialize($config);
    }
}