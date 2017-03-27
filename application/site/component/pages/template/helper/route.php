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
 * Route Template Helper
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Pages
 */
class PagesTemplateHelperRoute extends Library\TemplateHelperDefault
{
    /**
     * Find a page based on list of needles
     *
     * @param array $needles   An associative array of needles
     * @return
     */
    protected function _findPage($needles)
	{
        $extension = $this->getObject('application.extensions')->getExtension($this->getIdentifier()->package);
        $pages     = $this->getObject('application.pages');

        return $pages->find(array('extensions_extension_id' => $extension->id, 'link' => $needles));
	}
}