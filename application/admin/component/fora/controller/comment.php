<?php
/**
 * @package     Nooku_Server
 * @subpackage  Articles
 * @copyright	Copyright (C) 2011 - 2012 Timble CVBA and Contributors. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		http://www.nooku.org
 */

use Nooku\Library;
use Nooku\Component\Comments;

/**
 * Category Controller Class
 *
 * @author    	Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package     Nooku_Server
 * @subpackage  Fora
 */
class ForaControllerComment extends Comments\ControllerComment
{
    protected function _initialize(Library\ObjectConfig $config)
    {

        $config->append(array(
            'model' => 'com:fora.model.comments',
        ));
        parent::_initialize($config);
    }

    protected function _actionRender(Library\CommandContext $context)
    {

        return parent::_actionRender($context);
    }

    public function getRequest()
    {
        $request = parent::getRequest();

        //Force set the 'table' in the request
        $request->query->table  = 'fora';
        $request->data->table   = 'fora';

        return $request;
    }
}