<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Files;

use Nooku\Library;

/**
 * Files Html View
 *
 * @author  Ercan Ozkaya <http://nooku.assembla.com/profile/ercanozkaya>
 * @package Nooku\Component\Files
 */

class ViewFilesHtml extends Library\ViewHtml
{
	protected function _initialize(Library\ObjectConfig $config)
	{
		$config->auto_assign = false;

		parent::_initialize($config);
	}

	public function render()
	{
	    $state = $this->getModel()->getState();

        //Set the limit
        if (empty($state->limit)) {
	        $state->limit = $this->getObject('application')->getCfg('list_limit');
	    }

        //Set the container
        $this->container = $this->getModel()->getContainer();

        //Set the site
        $this->site = $this->getObject('application')->getSite();

        //Set the token
		$this->token  = $this->getObject('user')->getSession()->getToken();

		return parent::render();
	}
}
