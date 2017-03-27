<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Articles;

use Nooku\Library;

/**
 * Articles Database Table
 *
 * @author  Gergo Erdosi <http://nooku.assembla.com/profile/gergoerdosi>
 * @package Nooku\Component\Articles
 */
class DatabaseTableArticles extends Library\DatabaseTableAbstract
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'name'       => 'articles',
            'behaviors'  => array(
            	'creatable', 'modifiable', 'lockable', 'sluggable', 'revisable', 'publishable',
                'orderable' => array(
                    'strategy' => 'flat'
                ),
                'com:languages.database.behavior.translatable',
                'com:attachments.database.behavior.attachable',
                'com:tags.database.behavior.taggable'
            ),
            'filters' => array(
                'introtext'   => array('html', 'tidy'),
                'fulltext'    => array('html', 'tidy'),
		    )
        ));

        parent::_initialize($config);
    }
}