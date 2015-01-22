<?php
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class StreetsControllerLog extends Library\ControllerModel
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'behaviors' => array('editable'),
        ));

        parent::_initialize($config);
    }

    public function getRequest()
    {
        $request = parent::getRequest();

        $request->query->sort = 'created_on';
        $request->query->direction   = 'DESC';

        return $request;
    }
}