<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;
use Nooku\Component\Application;

/**
 * Page Controller
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Application
 */
class ApplicationControllerPage extends Application\ControllerPage
{
    /**
     * Constructor.
     *
     * @param  Library\ObjectConfig $config  An optional Library\ObjectConfig object with configuration options.
     */
    protected function  _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'toolbars'  => array('menubar', 'tabbar', 'actionbar'),
        ));

        parent::_initialize($config);
    }
}