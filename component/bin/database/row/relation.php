<?php
/**
 * Belgian Police Web Platform - Bin Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Bin;
use Nooku\Library;

class DatabaseRowRelation extends Library\DatabaseRowTable
{
    public function save()
    {
        if(!$this->id)
        {
            $this->id = sha1(time().$this->bin_district_id.$this->streets_street_id.$this->range_start.$this->range_end.$this->range_parity);
        }

        return parent::save();
    }
}