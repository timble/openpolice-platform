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
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package Nooku\Component\Fora
 */
class ForaTemplateHelperListbox extends Library\TemplateHelperListbox
{
    public function forums($config = array())
    {
        $config = new Library\ObjectConfig($config);
        $config->append(array(
            'model' => 'forums',
            'value'	=> 'id',
            'label'	=> 'title'
        ));

        return parent::_render($config);
    }

    public function statuses($config = array())
    {
        $config = new Library\ObjectConfig($config);
        $config->append(array(
            'model' => 'statuses',
            'value'	=> 'text',
            'label'	=> 'text',
            'filter'    => array(),
            'deselect'  => false
        ));

        return parent::_render($config);
    }

    /**
     * @param array $config
     * @return string
     */
    public function types($config = array())
    {
        $config = new Library\ObjectConfig($config);
        $config->append(array(
            'name'     => 'types',
            'selected' => 0,
        ));

        $types = array('article','idea','question','issue');

        foreach($types as $type){
            $options[] = $this->option(array(
                'label' => $type,
                'value' => $type
            ));
        }

        $config->options = $options;

        return $this->optionlist($config);
    }
}