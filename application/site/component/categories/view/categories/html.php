<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

/**
 * Categories Html View
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Categories
 */
class CategoriesViewCategoriesHtml extends Library\ViewHtml
{
	public function render()
	{
		$this->params = $this->getObject('application')->getParams();
		return parent::render();
	}
}