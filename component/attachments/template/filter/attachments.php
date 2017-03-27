<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2007 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

namespace Nooku\Component\Attachments;

use Nooku\Library;
use Nooku\Component\Files;

/**
 * Url Template Filter
 *
 * Filter rewrites relative attachments/... paths as inserted by the editor to absolute paths /files/[site]/attachments/...
 *
 * @author  Johan Janssens <https://github.com/johanjanssens>
 * @package Nooku\Component\Attachments
 */
class TemplateFilterAttachments extends Files\TemplateFilterFiles
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

        $path = $base->getPath().'/files/'.$site.'/attachments/';

        $config->append(array(
            'aliases' => array(
                'attachments://' => $path,
                '"attachments/'  => '"'.$path
            )
        ));

        parent::_initialize($config);
    }
}