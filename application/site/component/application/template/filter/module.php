<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */
use Nooku\Library;
use Nooku\Component\Pages;

/**
 * Module Template Filter Class
 *
 * @author    	Johan Janssens <https://github.com/johanjanssens>
 * @package     Nooku_Server
 * @subpackage  Application
 */
class ApplicationTemplateFilterModule extends Pages\TemplateFilterModule
{
    protected function _initialize(Library\ObjectConfig $config)
    {
        $config->append(array(
            'modules' => 'application.modules',
        ));

        parent::_initialize($config);
    }
}