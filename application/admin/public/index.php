<?php
/**
 * Nooku Framework - http://www.nooku.org
 *
 * @copyright	Copyright (C) 2011 - 2017 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

define('JPATH_ROOT'         , realpath($_SERVER['DOCUMENT_ROOT']));
define('JPATH_APPLICATION'  , JPATH_ROOT.'/application/admin');
define('JPATH_VENDOR'       , JPATH_ROOT.'/vendor' );
define('JPATH_SITES'        , JPATH_ROOT.'/sites');

define('JPATH_BASE'         , JPATH_APPLICATION );

define( 'DS', DIRECTORY_SEPARATOR );

require_once(__DIR__.'/bootstrap.php' );

Nooku\Library\ObjectManager::getInstance()->getObject('application')->run();
