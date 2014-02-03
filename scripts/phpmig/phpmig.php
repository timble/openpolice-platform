<?php
namespace MyPhpmig;

define('DS', DIRECTORY_SEPARATOR);

require_once dirname(__FILE__).DS.'config.php';

require_once dirname(__FILE__).DS.'Police'.DS.'Zones.php';
require_once dirname(__FILE__).DS.'Police'.DS.'Migration.php';

use \Phpmig\Adapter,
    \Phpmig\Pimple\Pimple;

$config = new PHPMigConfig();

$container = new Pimple();
$container['db'] = $container->share(function() use ($config) {
    return new \PDO('mysql:dbname=data;host='.$config->host, $config->user, $config->password);
});

$container['phpmig.adapter'] = $container->share(function() use ($container) {
    return new Adapter\PDO\Sql($container['db'], 'migrations');
});

$container['phpmig.migrations'] = $container->share(function() {
    $migrations = glob(__DIR__.'/migrations/*/*.php');

    // Only allow migrations that inherit from our custom migration class
    $allowed = array();
    foreach($migrations as $migration)
    {
        require_once $migration;

        $file = basename($migration);

        if(preg_match('/^[0-9]+/', $file, $matches))
        {
            $version = $matches[0];

            $classname = substr($file, 0, -4);
            $classname = preg_replace('/^[0-9]+_/', '', $classname);
            $classname = str_replace(array('_', ' '), '', $classname);

            $object = new $classname($version);

            if($object instanceof \MyPhpmig\Police\Migration) {
                $allowed[] = $migration;
            }
            else echo 'WARNING: '. $file . ' does not extend the \MyPhpmig\Police\Migration class! Skipping.'.PHP_EOL.PHP_EOL;
        }
    }

    return $allowed;
});

return $container;