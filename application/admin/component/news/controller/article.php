<?php
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.police.be
 */

use Nooku\Library;

class NewsControllerArticle extends Library\ControllerModel
{ 
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
        	'behaviors' => array(
                'editable',
                'com:activities.controller.behavior.loggable',
                'com:attachments.controller.behavior.attachable'
            ),
        ));
    
        parent::_initialize($config);
    }

    public function getRequest()
    {
        $request = parent::getRequest();

        $request->query->sort = 'ordering_date';
        $request->query->direction   = 'DESC';

        return $request;
    }
}