<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

/**
 * Tag Controller
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Component\Articles
 */
class ArticlesControllerTag extends TagsControllerTag
{ 
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'model'     => 'com:tags.model.tags',
            'request'   => array(
                'view' => 'tag'
            )
        ));

        parent::_initialize($config);
    }
}