<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2007 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Files;

use Nooku\Library;

/**
 * Url Template Filter
 *
 * Filter rewrites relative files/... paths as inserted by the editor to absolute paths /files/[site]/files/...
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Ckeditor
 */
class TemplateFilterFiles extends Library\TemplateFilterUrl
{
    /**
     * Initializes the options for the object
     *
     * Called from {@link __construct()} as a first step of object instantiation.
     *
     * @param   Library\ObjectConfig $config Configuration options
     * @return  void
     */
    protected function _initialize(Library\ObjectConfig $config)
    {
        //Make images paths absolute
        $base = $this->getObject('request')->getBaseUrl();
        $site = $this->getObject('application')->getSite();

        $path = $base->getPath().'/files/'.$site.'/files/';

        $config->append(array(
            'aliases' => array(
                'files://' => $path,
                '"files/'  => '"'.$path
            )
        ));

        parent::_initialize($config);
    }
}