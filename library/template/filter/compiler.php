<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2007 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Library;

/**
 * Compiler Template Filter Interface
 *
 * Filter will compile to the template to executable PHP code.
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Library\Template
 */
interface TemplateFilterCompiler
{
    /**
     * Parse the text and compile it to PHP
     *
     * @param string $text  The text to parse
     * @return void
     */
    public function compile(&$text);
}