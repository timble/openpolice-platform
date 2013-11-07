<?php
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Traffic;
use Nooku\Library;

class DatabaseRowArticle extends Library\DatabaseRowTable
{
    public function save()
    {
        // If created_on is modified then convert it to GMT/UTC
        if ($this->isModified('start_on'))
        {
            $this->start_on = gmdate('Y-m-d', strtotime($this->start_on));
        }

        // If created_on is modified then convert it to GMT/UTC
        if ($this->isModified('end_on'))
        {
            $this->end_on = gmdate('Y-m-d', strtotime($this->end_on));
        }

        $result = parent::save();

        return $result;
    }
}