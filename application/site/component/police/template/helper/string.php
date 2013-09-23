<?php
/**
 * Belgian Police Web Platform - Police Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class PoliceTemplateHelperString extends Library\TemplateHelperAbstract
{
    public function phone($config = array())
    {
        $config = new Library\ObjectConfig($config);

        $config->append(array('parameters' => $this->getObject('application.components')->articles->params))
            ->append(array(
                'row' => $this->getObject('com:police.database.row.zone')->set('id', $config->site)->load()
            ));

        $zone = $config->row;

        return '0123456789';
    }
}