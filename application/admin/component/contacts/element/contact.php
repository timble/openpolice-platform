<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

/**
 * Contact Element
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Contacts
 */
class JElementContact extends JElement
{
	var	$_name = 'Contact';

	function fetchElement($name, $value, &$node, $control_name)
	{
        $config = array(
            'name'     => $control_name . '[' . $name . ']',
            'selected' => $value,
            'table'    => $node->attributes('table'),
            'attribs'  => array('class' => 'inputbox'),
            'autocomplete' => true,
        );

        $template = Library\ObjectManager::getInstance()->getObject('com:contacts.controller.contact')->getView()->getTemplate();
        $html     = Library\ObjectManager::getInstance()->getObject('com:contacts.template.helper.listbox', array('template' => $template))->contacts($config);

        return $html;
	}
}
