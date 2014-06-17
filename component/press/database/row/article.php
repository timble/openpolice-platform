<?php
/**
 * Belgian Police Web Platform - Press Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Press;
use Nooku\Library;

class DatabaseRowArticle extends Library\DatabaseRowTable
{
    public function save()
    {
        // If created_on is modified then convert it to GMT/UTC
        if ($this->isModified('created_on') && !$this->isNew())
        {
            $this->created_on = gmdate('Y-m-d H:i:s', strtotime($this->created_on));
        }
        
        $result   = parent::save();

        return $result;
    }
}