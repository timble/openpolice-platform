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
 * Select Template Helper
 *
 * @author  Tom Janssens <http://nooku.assembla.com/profile/tomjanssens>
 * @package Component\Users
 */
class UsersTemplateHelperSelect extends Library\TemplateHelperSelect
{    
    public function users($config = array())
    {
    	$config = new Library\ObjectConfig($config);
        $config->options = $this->options(array(
            'entity' => $this->getObject('com:users.model.roles')->sort('id')->getRowset(),
            'label'  => 'name',
            'value'  => 'id',
        ));
    
    	return $this->checklist($config);
    }

    public function groups($config = array())
    {
        $config = new Library\ObjectConfig($config);
        $config->append(array(
            'name'  => 'role_id',
        ));

        $config->options = $this->options(array(
            'entity' => $this->getObject('com:users.model.roles')->sort('id')->getRowset(),
            'label'   => 'name'
        ));

        return $this->radiolist($config);
    }
}