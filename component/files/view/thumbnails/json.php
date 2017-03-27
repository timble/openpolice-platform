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
 * Thumbnails Json View
 *
 * @author  Ercan Ozkaya <http://nooku.assembla.com/profile/ercanozkaya>
 * @package Nooku\Component\Files
 */
class ViewThumbnailsJson extends ViewJson
{
    protected function _getRowset()
    {
        $list = $this->getModel()->getRowset();

        $results = array();
        foreach ($list as $item) 
        {
        	$key = $item->filename;
        	$results[$key] = $item->toArray();
        }

        ksort($results);

    	$data = parent::_getRowset();

        $data['items'] = $results;
        $data['total'] = count($list);

        return $data;
    }
}