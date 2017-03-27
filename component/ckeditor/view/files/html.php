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
 * Files Html View Class
 *
 * @author  Terry Visser <http://nooku.assembla.com/profile/terryvisser>
 * @package Nooku\Component\Ckeditor
 */
class ViewFilesHtml extends Files\ViewFilesHtml
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'auto_assign' => false
        ));

        parent::_initialize($config);
    }
}
