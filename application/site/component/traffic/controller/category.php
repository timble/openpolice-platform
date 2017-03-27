<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

/**
 * Category Controller Class
 *
 * @author      Johan Janssens <https://github.com/johanjanssens>
 * @package     Nooku_Server
 * @subpackage  Contacts
 */
class TrafficControllerCategory extends Library\ControllerModel
{
    public function getRequest()
    {
        $request = parent::getRequest();

        $request->query->published = 1;

        return $request;
    }
}
