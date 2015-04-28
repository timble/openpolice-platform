<?php
/**
 * Belgian Police Web Platform - Links Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Links;
use Nooku\Library;

class DatabaseTableLinks extends Library\DatabaseTableAbstract
{
    public function  _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'name'         => 'data.links',
            'behaviors'    =>  array(
                'creatable'
            ),
        ));

        parent::_initialize($config);
    }
}