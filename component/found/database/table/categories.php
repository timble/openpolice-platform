<?php
/**
 * Belgian Police Web Platform - Found Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Found;
use Nooku\Library;

class DatabaseTableCategories extends Library\DatabaseTableAbstract
{
    public function  _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'name'       => 'data.found_categories',
            'behaviors'  => array(
                'creatable', 'modifiable', 'lockable', 'sluggable',
                'com:languages.database.behavior.translatable',
                'deletable'
            ),
            'filters' => array(
                'description'   => array('html', 'tidy')
            )
        ));

        parent::_initialize($config);
    }
}
