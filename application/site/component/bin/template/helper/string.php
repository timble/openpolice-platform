<?php
/**
 * Belgian Police Web Platform - Bin Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class BinTemplateHelperString extends Library\TemplateHelperDefault
{
    public function street($config = array())
    {
        $config   = new Library\ObjectConfig($config);

        $district = $config->row;

        $html = false;

        if($district->range_parity != 'odd-even' || $district->range_start != '1' || $district->range_end < '999') {
            $html .= '(';
        }

        if($district->range_parity != 'odd-even' && $district->range_start != $district->range_end) {
            $html .= $this->translate($district->range_parity);

            if($district->range_start != '1' || $district->range_end < '999') {
                $html .= ' ';
            }
        }

        if($district->range_start != '1' || $district->range_end < '999') {
            if($district->range_start == $district->range_end){
                $html .= $district->range_start;
            } else {
                $html .= $this->translate('from').' '.$district->range_start.' '.JText::sprintf('to', $district->range_end);
            }
        }

        if($district->range_parity != 'odd-even' || $district->range_start != '1' || $district->range_end < '999') {
            $html .= ')';
        }

        return $html;
    }
}