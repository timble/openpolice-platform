<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2013 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		git://git.assembla.com/nooku-framework.git for the canonical source repository
 */

use Nooku\Library;
use Nooku\Component\Fora;
/**
 * Topic Controller
 *
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package Component\Fora
 */
class ForaControllerForum extends Fora\ControllerForum
{

    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array('toolbars'  => array('forum')));

        parent::_initialize($config);
    }


    public function getRequest()
    {
        $request = parent::getRequest();

        $request->query->sort  = "created_on";

        return $request;
    }
}