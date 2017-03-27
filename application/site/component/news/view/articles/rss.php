<?php
/**
 * Belgian Police Web Platform - News Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

/**
 * Articles RSS View
 *
 * @author  Tom Janssens <http://nooku.assembla.com/profile/tomjanssens>
 * @package Component\News
 */
class NewsViewArticlesRss extends Library\ViewRss
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'template_filters' => array('com:attachments.template.filter.attachments'),
        ));

        parent::_initialize($config);
    }

    public function render()
    {
        //Get the parameters
        $this->params = $this->getObject('application')->getParams();

        // Get the zone
        $this->zone = $this->getObject('com:police.model.zone')->id($this->getObject('application')->getCfg('site' ))->getRow();

        return parent::render();
    }
}