#!/usr/bin/php
<?php
// The SQL query to execute.
$sql = 'SELECT `users_user_id`, `name`, `email`, `users_role_id` FROM `users` WHERE `users_role_id` IN (23, 24);';

// Optional settings.
$options = array('exclude-default' => true);

// Connect to MySQL.
include dirname(__FILE__).'/../../config/config.php';
$config = new JConfig();
$mysqli = new mysqli('localhost', $config->user, $config->password);

// Get a list of installed sites.
$result = $mysqli->query('SHOW DATABASES LIKE \'v2_%\';');
while($row = $result->fetch_row()) {
    $sites[] = substr($row[0], 3);
}

$result->close();

if($options['exclude-default'])
{
    $key = array_search('default', $sites);

    if($key !== false) {
        unset($sites[$key]);
    }
}

// Always exclude `demo` database
$key = array_search('demo', $sites);
if($key !== false) {
    unset($sites[$key]);
}

// Execute the query.
foreach($sites as $site)
{
    $mysqli->select_db('v2_'.$site);
    $result = $mysqli->query($sql);
    
    while($row = $result->fetch_assoc()) {
        $users[$row['email']] = array($row['name'], $row['email'], $site, $row['users_role_id']);
    }
    
    $result->close();
}

$output = '"name","email","site","users_role_id"';
foreach($users as $user) {
    $output .= PHP_EOL.'"'.implode('","', $user).'"';
}

file_put_contents('users.csv', $output);