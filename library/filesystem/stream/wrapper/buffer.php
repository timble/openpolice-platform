<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2007 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Library;

/**
 * Buffer FileSystem Stream Wrapper
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Library\FileSystem
 */
class FilesystemStreamWrapperBuffer extends FilesystemStreamWrapperAbstract
{
    /**
     * Initializes the options for the object
     *
     * Called from {@link __construct()} as a first step of object instantiation.
     *
     * @param  ObjectConfig $config An optional ObjectConfig object with configuration options
     * @return void
     */
    protected function _initialize(ObjectConfig $config)
    {
        $config->append(array(
            'protocol' => 'buffer',
            'type'     => FilesystemStreamInterface::TYPE_MEMORY
        ));
    }
}