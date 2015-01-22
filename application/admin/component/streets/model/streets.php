<?php
/**
 * Belgian Police Web Platform - Streets Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Component\Streets;
use Nooku\Library;

class StreetsModelStreets extends Streets\ModelStreets
{
    protected function _buildQueryWhere(Library\DatabaseQuerySelect $query)
    {
        parent::_buildQueryWhere($query);
        $state = $this->getState();

        $languages = $this->getObject('application.languages');

        $query->where('tbl.iso = :iso')->bind(array('iso' => $languages->getActive()->slug));
    }
}