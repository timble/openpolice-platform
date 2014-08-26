<?php
use Nooku\Library;

// Avoid notices in DispatcherRequestAbstract by setting these superglobals:
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
$_SERVER['SERVER_PORT'] = 80;

define('JPATH_ROOT'         , realpath(dirname(__FILE__).'/../../'));
define('JPATH_APPLICATION'  , JPATH_ROOT.'/application/admin');
define('JPATH_VENDOR'       , JPATH_ROOT.'/vendor');
define('JPATH_SITES'        , JPATH_ROOT.'/sites');

define('JPATH_BASE'         , JPATH_APPLICATION);

define('DS', DIRECTORY_SEPARATOR);

if (!file_exists(JPATH_ROOT . '/config/config.php') || (filesize(JPATH_ROOT . '/config/config.php') < 10)) {
    throw new \InvalidArgumentException('No configuration file found.');
}

require_once(JPATH_VENDOR . '/joomla/import.php');
jimport('joomla.environment.uri');
jimport('joomla.html.html');
jimport('joomla.html.parameter');
jimport('joomla.utilities.utility');
jimport('joomla.language.language');

require_once JPATH_ROOT.'/config/config.php';
$config = new \JConfig();

require_once(JPATH_ROOT.'/library/nooku.php');

\Nooku::getInstance(array(
    'cache_prefix' => md5($config->secret) . '-cache-koowa',
    'cache_enabled' => $config->caching
));

unset($config);

Library\ClassLoader::getInstance()->getLocator('com')->registerNamespaces(
    array(
        '\\'              => JPATH_APPLICATION.'/component',
        'Nooku\Component' => JPATH_ROOT.'/component'
    )
);

Library\ClassLoader::getInstance()->addApplication('admin', JPATH_ROOT.'/application/admin');

$manager = Library\ObjectManager::getInstance();
$manager->getObject('lib:bootstrapper.application', array(
    'directory' => JPATH_APPLICATION.'/component'
))->bootstrap();

// Disable error handler when we are running in CLI mode:
$config = new Library\ObjectConfig(array(
    'object_manager' => Library\ObjectManager::getInstance(),
    'object_identifier' => new Library\ObjectIdentifier('lib:event.dispatcher'),
    'catch_exceptions'  => false,
    'catch_user_errors' => false,
    'catch_core_errors' => false
));

$instance  = new Nooku\Library\EventDispatcher($config);
$manager->setObject('lib:event.dispatcher', $instance);

$manager->registerAlias('event.dispatcher', 'lib:event.dispatcher');