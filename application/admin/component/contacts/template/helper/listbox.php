<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

use Nooku\Library;

/**
 * Listbox Template Helper
 *
 * @author  Gergo Erdosi <http://nooku.assembla.com/profile/gergoerdosi>
 * @package Component\Contacts
 */
class ContactsTemplateHelperListbox extends Library\TemplateHelperListbox
{
    public function contacts($config = array())
    {
        $config = new Library\ObjectConfig($config);
        $config->append(array(
            'model' => 'contacts',
            'value'	=> 'id',
            'label'	=> 'title'
        ));

        return parent::_render($config);
    }

    public function days($config = array())
    {
        $config = new Library\ObjectConfig($config);
        $config->append(array(
            'attribs'   => array(),
            'selected'  => 0
        ));

        $options = array();

        $options[] = $this->option(array('label' => JText::_( 'Monday' ), 'value' => '1'));
        $options[] = $this->option(array('label' => JText::_( 'Tuesday' ) , 'value' => '2' ));
        $options[] = $this->option(array('label' => JText::_( 'Wednesday' ), 'value' => '3' ));
        $options[] = $this->option(array('label' => JText::_( 'Thursday' ), 'value' => '4'));
        $options[] = $this->option(array('label' => JText::_( 'Friday' ) , 'value' => '5' ));
        $options[] = $this->option(array('label' => JText::_( 'Saturday' ), 'value' => '6' ));
        $options[] = $this->option(array('label' => JText::_( 'Sunday' ), 'value' => '7' ));

        //Add the options to the config object
        $config->options = $options;

        return $this->optionlist($config);
    }
}