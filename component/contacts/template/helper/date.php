<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Contacts;

use Nooku\Library;

/**
 * Date Template Helper
 *
 * @author  Tom Janssens <http://nooku.assembla.com/profile/tomjanssens>
 * @package Nooku\Component\Contacts
 */
class TemplateHelperDate extends Library\TemplateHelperDate
{
    public function weekday($config = array())
    {
        $config = new Library\ObjectConfig($config);
        $config->append(array(
            'translate' => true
        ));

        $day = date('l', strtotime("Sunday +{$config->day_of_week} days"));

        if($config->translate) {
            $day = \JText::_($day);
        }
    
        return $day;
    }
}