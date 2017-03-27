<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Extensions;

use Nooku\Library;

/**
 * Settings Json View
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Extensions
 */
class ViewSettingsJson extends Library\ViewJson
{
    public function render()
    {
        $model = $this->getModel();

        if(Library\StringInflector::isPlural($this->getName())) {
            $data = array('settings' => $model->getRowset()->toArray());
        } else {
            $data = $model->getRow()->toArray();
        }

        $this->setContent($data);

        return parent::render();
    }
}