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
 * Html Page View
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Application
 */
class ApplicationViewPageHtml extends Application\ViewPageHtml
{
    /**
     * Get the title
     *
     * @return 	string 	The title of the view
     */
    public function getTitle()
    {
        $title = $this->getObject('application')->getCfg('sitename' );
        return $title;
    }
}