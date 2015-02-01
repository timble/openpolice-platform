<?php
/**
 * This script will fetch the latest database dumps
 * and sync the source files with production to synchronize
 * the staging server with the current live version.
 *
 * Make sure staging's root can SSH to production as the deploy user
 * using public key authentication.
 */

$path = realpath(dirname(__FILE__).'/../../config/config.php');

if(!file_exists($path)) {
    exit('Could not find config file ('.$path.')');
}

require_once $path;

$config = new \JConfig();

// Start syncing
$tmp = '/tmp/'.uniqid();

// Start with the mysql dumps: get the most recent one from
// the production backups and import every db
echo "-- Syncing MySQL databases" . PHP_EOL;
$dumps_dir = $tmp.'/mysql/';
mkdir($dumps_dir, 0755, true) or exit('Could not create ' . $dumps_dir);
chdir($dumps_dir) or exit('Could not change working directory to' . $dumps_dir);

// Get the latest file name
$filename = exec("ssh -p 9999 deploy@172.18.150.10 \"ls -alhr /var/backups/databases/daily/ --sort=time | grep 'platform' | tail -n 1 | awk '{print \\$9}'\"");

if(empty($filename)) exit('No MySQL dump found!');

// Download the file and extract
echo "-- Downloading " . $filename . ' archive' . PHP_EOL;
exec('scp -P 9999 deploy@172.18.150.10:/var/backups/databases/daily/' . $filename . ' ' . $dumps_dir.$filename);
exec('tar -xvf ' . $filename);

// Now loop over all the databases and import
echo "-- Importing all databases".PHP_EOL;
foreach(glob("*.sql") as $file)
{
    $database = substr($file, 0, -4);

    echo "Drop existing database " . $database . PHP_EOL;
    exec("mysql -u".escapeshellarg($config->user)." -p".escapeshellarg($config->password)." -e 'DROP DATABASE IF EXISTS `".$database."`;'");

    echo "Re-creating database " . $database . PHP_EOL;
    exec("mysql -u".escapeshellarg($config->user)." -p".escapeshellarg($config->password)." -e 'CREATE DATABASE IF NOT EXISTS `".$database."`;'");

    echo "Importing " . $file . PHP_EOL;
    exec("mysql -u".escapeshellarg($config->user)." -p".escapeshellarg($config->password)." ".$database." < " . $file);
}

// Execute the migrations that might 've been enabled on staging already
echo "-- Running phpmig migrate".PHP_EOL;
exec('cd /var/www/v2.lokalepolitie.be/capistrano/current/scripts/phpmig/ && phpmig migrate');

// Now rsync the source files
echo "-- Syncing shared folders".PHP_EOL;
exec('rsync --rsh "ssh -p 9999" deploy@172.18.150.10:/var/www/v2.lokalepolitie.be/capistrano/shared/ /var/www/v2.lokalepolitie.be/capistrano/shared/ --delete --update --perms --owner --group --recursive --times --links');

// Get rid of our temporary directories and files
chdir('/tmp/');
exec('rm -rf ' . $tmp);