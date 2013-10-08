<?php
/**
 * Belgian Police Web Platform - Traffic Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class TrafficTemplateHelperDate extends Library\TemplateHelperDate
{
    public function timestamp($config = array())
    {
        $config = new Library\ObjectConfig($config);
        $config->append(array(
            'start_on'   => null,
            'end_on'     => null
        ));

        $html = array();

        $html[] = $this->format(array('date'=> $config->start_on, 'format' => $this->translate('DATE_FORMAT_LC4')));

        if (!$config->end_on) {
            $html[] = '-';
            $html[] = $this->translate('end undefined');
        }

        if ($config->start_on < $config->end_on) {
            $html[] = '-';
            $html[] = $this->format(array('date'=> $config->end_on, 'format' => $this->translate('DATE_FORMAT_LC4')));
        }

        return implode(' ', $html);
    }
}