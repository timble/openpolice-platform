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
 * Listbox Template Helper
 *
 * @author  Tom Janssens <http://nooku.assembla.com/profile/tomjanssens>
 * @package Component\Tags
 */
class TagsTemplateHelperListbox extends Library\TemplateHelperListbox
{
    public function tags($config = array())
    {
    	$config = new Library\ObjectConfig($config);
    	$config->append(array(
    		'model'  => 'tags',
    		'value'	 => 'id',
    		'label'	 => 'title',
            'prompt' => false
        ));
        
        $config->label = 'title';
		$config->sort  = 'title';
    
    	return parent::_render($config);
    }
}