<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2007 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Library;

/**
 * Renderer Template Filter Interface
 *
 * Filter will parse and render to the template to an HTML string
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Library\Template
 */
interface TemplateFilterRenderer
{
    /**
     * Parse the text and render it
     *
     * @param string $text  The text to parse
     * @return void
     */
    public function render(&$text);
}