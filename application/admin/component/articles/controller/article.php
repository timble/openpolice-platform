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
 * Article Controller
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Articles
 */
class ArticlesControllerArticle extends Library\ControllerModel
{ 
    protected function _initialize(Library\ObjectConfig $config)
    {
    	$config->append(array(
    		'behaviors' => array(
                'editable',
    	        'com:activities.controller.behavior.loggable',
    	        'com:revisions.controller.behavior.revisable',
    		    'com:languages.controller.behavior.translatable',
                'com:attachments.controller.behavior.attachable',
                'com:tags.controller.behavior.taggable'
    	    )
    	));
    
    	parent::_initialize($config);
    }
}