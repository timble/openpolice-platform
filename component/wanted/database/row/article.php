<?php
/**
 * Belgian Police Web Platform - Wanted Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Wanted;
use Nooku\Library;

class DatabaseRowArticle extends Library\DatabaseRowTable
{
    public function __get($column)
    {
        if($column == 'params')
        {
            $this->_data['params'] = json_decode($this->_data['params'], true);
        }

        return parent::__get($column);
    }
}