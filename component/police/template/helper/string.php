<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Police;

use Nooku\Library;

class TemplateHelperString extends Library\TemplateHelperDefault
{
    public function language($config = array())
    {
        $config   = new Library\ObjectConfig($config);

        $language_short = explode("-", $this->getObject('application')->getCfg('language'));
        $language_short = $language_short[0];

        return $language_short;
    }
}