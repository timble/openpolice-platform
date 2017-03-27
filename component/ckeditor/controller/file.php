<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Ckeditor;

use Nooku\Library;
use Nooku\Component\Files;

/**
 * File Controller
 *
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package Nooku\Component\Ckeditor
 */
class ControllerFile extends Files\ControllerFile
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'model'   => 'com:files.model.files',
        ));
        parent::_initialize($config);

    }
}
