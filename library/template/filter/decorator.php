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
 * Decorator Template Filter
 *
 * Replace <ktml:content> with the view contents allowing to the template to act as a view decorator.
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Library\Template
 */
class TemplateFilterDecorator extends TemplateFilterAbstract implements TemplateFilterRenderer
{
    /**
	 * Replace <ktml:content> with the view content
	 *
	 * @param string $text  The text to parse
	 * @return void
	 */
	public function render(&$text)
	{
        $matches = array();
        if(preg_match_all('#<ktml:content(.*)>#iU', $text, $matches))
        {
            foreach($matches[1] as $key => $match) {
                $text = str_replace($matches[0][$key], $this->getTemplate()->getView()->getContent(), $text);
            }
        }
	}
}
