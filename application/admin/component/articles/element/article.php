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
 * Article Element
 *
 * @author Gergo Erdosi <http://nooku.assembla.com/profile/gergoerdosi>
 * @package Component\Articles
 */
class JElementArticle extends JElement
{
    var $_name = 'Article';

    public function fetchElement($name, $value, &$node, $control_name)
    {
        $config = array(
            'name'     => $control_name . '[' . $name . ']',
            'selected' => $value,
            'table'    => $node->attributes('table'),
            'attribs'  => array('class' => 'inputbox'),
            'autocomplete' => true,
        );

        $template = Library\ObjectManager::getInstance()->getObject('com:pages.view.page')->getTemplate();
        $html     = Library\ObjectManager::getInstance()->getObject('com:articles.template.helper.listbox', array('template' => $template))->articles($config);

        return $html;
    }
}