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
 * Directory Controller
 *
 * @author  Arunas Mazeika <http://nooku.assembla.com/profile/arunasmazeika>
 * @package Component\Files
 */
class FilesControllerDirectory extends Library\ControllerModel
{
    public function getRequest()
    {
        $request = parent::getRequest();

        // Force container.
        $request->query->set('container', 'files-files');

        if ($request->query->get('view', 'cmd') == 'directory')
        {
            $page = $this->getObject('application.pages')->getActive();

            $params = new JParameter($page->params);
            if (isset($params->limit) && $params->limit > 0) {
                $request->query->set('limit', $params->limit);
            }
        }

        return $request;
    }
}