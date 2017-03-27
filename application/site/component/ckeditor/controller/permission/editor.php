<?php
/**
 * @package        Nooku_Server
 * @subpackage     Articles
 * @copyright      Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license        GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link           http://www.nooku.org
 */

use Nooku\Library;

/**
 * Editor Controller Permission Class
 *
 * @author     Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package    Nooku_Server
 * @subpackage Ckeditor
 */
class CkeditorControllerPermissionEditor extends ApplicationControllerPermissionDefault
{
    public function canRender()
    {
        return true;
    }
}
