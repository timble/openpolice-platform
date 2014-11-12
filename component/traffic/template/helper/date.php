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

class TemplateHelperDate extends Library\TemplateHelperDate
{
    public function timestamp($config = array())
    {
        $config = new Library\ObjectConfig($config);
        $config->append(array(
            'start_on'   => null,
            'end_on'     => null
        ));

        $start_on = new \DateTime($config->start_on);
        $start_on = $start_on->format('c');

        $end_on = new \DateTime($config->end_on);
        $end_on = $end_on->format('c');

        $html = array();

        $html[] = '<time itemprop="startDate" datetime="'.$start_on.'">';
        $html[] = $this->format(array('date'=> $config->start_on, 'format' => $this->translate('DATE_FORMAT_LC4')));
        $html[] = '</time>';

        if (!$config->end_on) {
            $html[] = '-';
            $html[] = $this->translate('end undefined');
        }

        if ($config->start_on < $config->end_on) {
            $html[] = '-';
            $html[] = '<time itemprop="endDate" datetime="'.$end_on.'">';
            $html[] = $this->format(array('date'=> $config->end_on, 'format' => $this->translate('DATE_FORMAT_LC4')));
            $html[] = '</time>';
        }

        return implode(' ', $html);
    }
}
