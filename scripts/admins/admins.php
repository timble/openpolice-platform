#!/usr/bin/php
<?php
// The SQL query to execute.
$sql = 'SELECT `users_user_id`, `name`, `email`, `users_role_id` FROM `users` WHERE `users_role_id` IN (23, 24);';

// Optional settings.
$options = array('exclude-base' => true);

// Connect to MySQL.
include dirname(__FILE__).'/../../config/config.php';
$config = new JConfig();
$mysqli = new mysqli('localhost', $config->user, $config->password);

// Get a list of installed sites.
$result = $mysqli->query('SHOW DATABASES LIKE \'____\';');
while($row = $result->fetch_row()) {
    $sites[] = $row[0];
}

$result->close();

if($options['exclude-base'])
{
    $key = array_search('base', $sites);

    if($key !== false) {
        unset($sites[$key]);
    }
}

// Always exclude `demo` and `data` database
foreach(array('demo', 'data') as $name)
{
    $key = array_search($name, $sites);

    if($key !== false) {
        unset($sites[$key]);
    }
}

// Execute the query.
$users = array();
foreach($sites as $site)
{
    $mysqli->select_db($site);
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