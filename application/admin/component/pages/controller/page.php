<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

/**
 * Page Controller
 *
 * @author  Gergo Erdosi <http://nooku.assembla.com/profile/gergoerdosi>
 * @package Component\Pages
 */
class PagesControllerPage extends Library\ControllerModel
{
    protected function _initialize(Library\ObjectConfig $config)
    {
    	$config->append(array(
    		'behaviors' => array(
                'editable', 'closurable',
                'com:languages.controller.behavior.translatable'
            )
    	));
    
    	parent::_initialize($config);
    }
}