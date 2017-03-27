<?php
/**
 * Belgian Police Web Platform - Analytics Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
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