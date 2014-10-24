<?php
/**
 * Belgian Police Web Platform - About Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\About;
use Nooku\Library;

class DatabaseTableCategories extends Library\DatabaseTableAbstract
{
    public function  _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'behaviors'  => array(
                'creatable', 'modifiable', 'lockable', 'sluggable',
                'com:attachments.database.behavior.attachable',
                'com:languages.database.behavior.translatable',
                'deletable',
                'orderable' => array(
                    'strategy' => 'flat'
                ),
            ),
            'filters' => array(
                'description'   => array('html', 'tidy')
            )
        ));

        parent::_initialize($config);
    }
}
