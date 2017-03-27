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
 * Users Dispatcher
 *
 * @author      Gergo Erdosi <http://nooku.assembla.com/profile/gergoerdosi>
 * @package Component\Users
 */
class UsersDispatcherHttp extends Library\DispatcherHttp
{
    public function __construct(Library\ObjectConfig $config)
    {
        parent::__construct($config);

        //@TODO Remove when PHP 5.5 becomes a requirement.
        Library\ClassLoader::getInstance()->loadFile(JPATH_ROOT.'/application/admin/component/users/legacy/password.php');
    }
}