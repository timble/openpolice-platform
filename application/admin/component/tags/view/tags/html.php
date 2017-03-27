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
 * Tags Html View
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Tags
 */
class TagsViewTagsHtml extends Library\ViewHtml
{
	public function render()
	{
		//If no row exists assign an empty array
		if($this->getModel()->getState()->row) {
			$this->disabled = false;
		} else {
			$this->disabled = true;
		}
			
		return parent::render();
	}
}
