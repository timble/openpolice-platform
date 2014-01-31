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
$cmd = 'mysqladmin -u'.escapeshellarg($config->user).' -p'.escapeshellarg($config->password).' -f drop demo;';
exec($cmd);

echo "-- Dump 5388 database" . PHP_EOL;
$cmd = 'mysqldump --complete-insert --add-drop-table --extended-insert --quote-names';
$cmd .= ' -u'.escapeshellarg($config->user).' -p'.escapeshellarg($config->password).' '.escapeshellarg('5388');
$cmd .= ' > /tmp/5388.sql';
exec($cmd);

echo "-- Re-create demo database " . PHP_EOL;
exec("mysql -u".escapeshellarg($config->user)." -p".escapeshellarg($config->password)." -e 'CREATE DATABASE IF NOT EXISTS `demo`;'");

echo "-- Import dump into demo database" . PHP_EOL;
$cmd = "mysql -u".escapeshellarg($config->user)." -p".escapeshellarg($config->password)." demo < /tmp/5388.sql";
exec($cmd);

// Now rsync the sites folder
echo "-- Syncing site folders".PHP_EOL;
exec('rsync -vr /var/www/v2.lokalepolitie.be/capistrano/shared/sites/5388/ /var/www/v2.lokalepolitie.be/capistrano/shared/sites/demo/ --exclude config/config.php --delete --update --perms --owner --group --recursive --times --links');

// Remove users and setup demo access
echo "-- Setting up demo user".PHP_EOL;
$queries = <<<EOL
    DELETE FROM `demo`.`users` WHERE `users_user_id` != 1;
    INSERT INTO `demo`.`users` VALUES (6, 'Demo User', 'belgianpolice@localhost.home', 1, 0, 24, NULL, 1, '2013-10-03 15:05:47', NULL, NULL, NULL, NULL, '', 'timezone=Europe/Brussels\n\n', '784ba67a-e761-467b-ad27-c9224cbf9f52');
    INSERT INTO `demo`.`users_passwords` VALUES ('belgianpolice@localhost.home', NULL, '$2y$10$/i.iNRmsgFpJFLN6GTS6BODybYCK8Hm.kVm5ydGrO74x2wYzUBfjK', '');
EOL;

file_put_contents('/tmp/query.sql', $queries);
$cmd = "mysql -u".escapeshellarg($config->user)." -p".escapeshellarg($config->password)." demo < /tmp/query.sql";
exec($cmd);

// Clean-up
unlink('/tmp/5388.sql');
unlink('/tmp/query.sql');