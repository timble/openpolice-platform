<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;
use Nooku\Component\Application;

/**
 * Exception Controller
 *   
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Application
 */
class ApplicationControllerException extends Application\ControllerException
{
    public function getRequest()
    {
        $request = parent::getRequest();

        //Force layout to default.
        $request->query->layout = 'default';

        return $request;
    }
}