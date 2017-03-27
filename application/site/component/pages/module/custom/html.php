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
 * Custom Module Html View
 *
 * @author  Tom Janssens <http://nooku.assembla.com/profile/tomjanssens>
 * @package Component\Pages
 */
class PagesModuleCustomHtml extends PagesModuleDefaultHtml
{
    public function render()
    {        
        $this->show_title = $this->module->params->get('show_title', false);
        $this->class      = $this->module->params->get('class', false);
        
        return parent::render();
    }
} 