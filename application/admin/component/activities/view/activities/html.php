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
 * Activities Html View
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Activities
 */
class ActivitiesViewActivitiesHtml extends Library\ViewHtml
{
	public function render()
	{
        if ($this->getLayout() == 'default')
		{
			$model = $this->getObject($this->getModel()->getIdentifier());
            $this->packages = $model->distinct(true)->column('package')->getRowset();
		} 
		
		return parent::render();
	}
}