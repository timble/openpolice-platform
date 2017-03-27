<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Application;

use Nooku\Library;

/**
 * Style Template Filter
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Application
 */
class TemplateFilterStyle extends Library\TemplateFilterStyle
{
    public function render(&$text)
    {
        $styles = $this->_parseTags($text);
        $text = str_replace('<ktml:style>', $styles, $text);
    }
}