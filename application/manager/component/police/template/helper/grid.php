<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class PoliceTemplateHelperGrid extends Library\TemplateHelperGrid
{
    public function language($config = array())
    {
        $config = new Library\ObjectConfig($config);
        $config->append(array(
            'language'  => ''
        ));

        $html = null;

        $language = array();
        $language[1] = 'NL';
        $language[2] = 'FR';
        $language[3] = 'NL & FR';
        $language[4] = 'DE';

        $html = $language[$config->language];

        return $html;
    }
}
