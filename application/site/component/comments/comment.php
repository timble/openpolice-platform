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
 * Comment Controller
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Comments
 */
abstract class CommentsControllerComment extends Library\ControllerModel
{ 
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
        	'behaviors' => array('editable'),
        ));
        
        parent::_initialize($config);
    }
}