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
            $timezone = new \DateTimeZone(date_default_timezone_get());
            $offset = $timezone->getOffset(new \DateTime("now")); // Offset in seconds
            $offset = ($offset < 0 ? '-' : '+').round($offset/3600); // prints "+11"

            $date = new \DateTime($this->start_on);
            $date->modify($offset.' hours');

            $this->start_on = $date->format('Y-m-d H:i:s');
        }

        // If created_on is modified then convert it to GMT/UTC
        if ($this->isModified('end_on'))
        {
            $timezone = new \DateTimeZone(date_default_timezone_get());
            $offset = $timezone->getOffset(new \DateTime("now")); // Offset in seconds
            $offset = ($offset < 0 ? '-' : '+').round($offset/3600); // prints "+11"

            $date = new \DateTime($this->end_on);
            $date->modify($offset.' hours');

            $this->end_on = $date->format('Y-m-d H:i:s');
        }

        $result = parent::save();

        return $result;
    }
}