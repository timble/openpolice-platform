<?php
/**
 * Belgian Police Web Platform - About Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Wanted;
use Nooku\Library;

class DatabaseTableCategories extends Library\DatabaseTableAbstract
{
    public function  _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'behaviors'  => array(
                'sluggable', 'creatable', 'modifiable', 'lockable',
                'com:languages.database.behavior.translatable'
            ),
            'filters' => array(
                'description'   => array('html', 'tidy')
            )
        ));

        parent::_initialize($config);
    }
}
