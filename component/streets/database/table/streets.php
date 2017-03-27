<?php
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Streets;
use Nooku\Library;

class DatabaseTableStreets extends Library\DatabaseTableAbstract
{    
    public function  _initialize(Library\ObjectConfig $config)
    {
        $behaviors = array('sluggable');

        // @TODO: /scripts/crons/_bootstrap.php does not dispatch an application.
        // This means that no user session has been created yet. The $this->getObject('user') call
        // will throw errors when we call it from CLI.
        // To work around this, only include these behaviors when we're not in CLI context.
        if (php_sapi_name() != 'cli') {
            $behaviors = array_merge($behaviors, array('lockable', 'creatable', 'modifiable'));
        }

        $config->append(array(
            'name'      => 'data.streets',
            'behaviors' =>  $behaviors
        ));
     
        parent::_initialize($config);
     }
}