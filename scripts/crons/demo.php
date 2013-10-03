<?php
/**
 * This script will sync the /demo site with /5388 zone
 *
 * This script should run on production every night.
 */

// Get the authentication credentials
$authfile = '/var/www/v2.lokalepolitie.be/private/db.auth';
if(!file_exists($authfile)) {
    exit('Could not find MySQL credentials ('.$authfile.')');
}

$config = new stdClass;

$contents   = trim(file_get_contents($authfile));
$values     = explode(':', $contents);

$config->user = $values[0];
$config->password = implode('', array_slice($values, 1));

echo "-- Drop demo database" . PHP_EOL;
$cmd = 'mysqladmin -u'.escapeshellarg($config->user).' -p'.escapeshellarg($config->password).' -f drop v2_demo;';
exec($cmd);

echo "-- Dump 5388 database" . PHP_EOL;
$cmd = 'mysqldump --complete-insert --add-drop-table --extended-insert --quote-names';
$cmd .= ' -u'.escapeshellarg($config->user).' -p'.escapeshellarg($config->password).' '.escapeshellarg('v2_5388');
$cmd .= ' > /tmp/5388.sql';
exec($cmd);

echo "-- Re-create demo database " . PHP_EOL;
exec("mysql -u".escapeshellarg($config->user)." -p".escapeshellarg($config->password)." -e 'CREATE DATABASE IF NOT EXISTS `v2_demo`;'");

echo "-- Import dump into demo database" . PHP_EOL;
$cmd = "mysql -u".escapeshellarg($config->user)." -p".escapeshellarg($config->password)." v2_demo < /tmp/5388.sql";
exec($cmd);

// Now rsync the sites folder
echo "-- Syncing site folders".PHP_EOL;
exec('rsync -vr /var/www/v2.lokalepolitie.be/capistrano/shared/sites/5388/ /var/www/v2.lokalepolitie.be/capistrano/shared/sites/demo/ --delete --update --perms --owner --group --recursive --times --links');

// Clean-up
exec('rm -f /tmp/5388.sql');