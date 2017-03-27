<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Extensions;

use Nooku\Library;

/**
 * Settings Model
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Extensions
 */
class ModelSettings extends Library\ModelAbstract
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        $this->getState()
             ->insert('name', 'cmd', null, true);        
    }
     
    public function getRow()
    {
        if(isset($this->getRowset()->{$this->getState()->name})) {
            $row = $this->getRowset()->{$this->getState()->name};
        } else {
            $row = $this->getRowset()->getRow();
        }
        
        return $row;
    }
    
    public function getRowset()
    {
        if (!isset($this->_rowset))
        {
            $rowset = $this->getObject('com:extensions.database.rowset.settings');
            
            //Insert the system configuration settings
            $rowset->insert($this->getObject('com:extensions.database.row.setting_system'));
                        
            //Insert the component configuration settings
            $extensions = $this->getObject('com:extensions.model.extensions')->enabled(1)->getRowset();

            foreach($extensions as $extension)
            {
                $path  = Library\ClassLoader::getInstance()->getApplication('admin');
                $path .= '/component/'.substr($extension->name, 4).'/resources/config/settings.xml';

                if(file_exists($path))
                {
                    $config = array(
                        'name' => strtolower(substr($extension->name, 4)),
                        'path' => file_exists($path) ? $path : '',
                        'id'   => $extension->id,
                        'data' => $extension->params->toArray(),
                    );

                    $row = $this->getObject('com:extensions.database.row.setting_extension', $config);

                    $rowset->insert($row);
                }
            }
             
            $this->_rowset = $rowset;
        }

        return $this->_rowset;
    }
}  