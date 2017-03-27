<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Contacts;

use Nooku\Library;

/**
 * Contacts Database Table
 *
 * @author  Isreal Canasa <http://nooku.assembla.com/profile/israelcanasa>
 * @package Nooku\Component\Contacts
 */
class DatabaseTableContacts extends Library\DatabaseTableAbstract
{
	protected function _initialize(Library\ObjectConfig $config)
	{
        $config->append(array(
            'name' => 'contacts',
            'behaviors' => array(
                'sluggable', 'creatable', 'modifiable', 'lockable',
                'orderable' => array(
                    'strategy' => 'flat'
                ),
                'com:attachments.database.behavior.attachable',
                'com:languages.database.behavior.translatable',
                'com:streets.database.behavior.locatable'
            ),
             'filters' => array(
                 'misc'     => array('html', 'tidy'),
                 'params'   => 'ini'
            )
        ));
        
		parent::_initialize($config);
	}
}
