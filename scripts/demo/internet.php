#!/usr/bin/env php
<?php

namespace Nooku;

// Run the class from request if the script is called directly from the command line
if (!count(debug_backtrace())) {
    Installer::fromInput($argv);
}

class Installer
{
    public static $files = array(
        'schema.sql', 'data.sql', 'sample.sql'
    );

    public $task;
    public $database = '9999';
    public $www = '/var/www/internet.openpolice.be';

    public function __construct($task)
    {
        if (!in_array($task, array('install', 'reinstall'))) {
            throw new \InvalidArgumentException('Invalid task: '.$task);
        }

        $this->task = $task;
    }

    public static function fromInput($argv)
    {
        $task = isset($argv[1]) ? $argv[1] : '';

        $instance = new self($task);
        $instance->run();
    }

    public function run()
    {
        try {
            $this->precheck();

            $task = $this->task;
            $this->$task();
        }
        catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function install()
    {
        `cd $this->www && git pull origin master`;

        $this->createDatabase();
        $this->setupMapping();
        $this->createMultisite('default');
        $this->createMultisite();
        $this->modifyConfiguration();
        $this->runComposer();
        $this->runPhpmig();
    }

    public function uninstall()
    {
        $this->deleteFiles();

        $this->deleteDatabase();
        $this->deleteIndices();
    }

    public function reinstall()
    {
        $this->uninstall();
        $this->install();
    }

    public function precheck()
    {
    }

    public function createMultisite($site = '9999')
    {
        $template = <<<EOF
<?php
class JSiteConfig extends JConfig
{
	var \$theme = 'mobile';
	var \$analytics = 'UA-20242887-6';
	var \$site = '$site';
}
EOF;

        $dir = $this->www."/sites/$site/config";
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        file_put_contents($dir.'/config.php', $template);

        mkdir($this->www."/sites/$site/files/attachments", 0777, true);
        mkdir($this->www."/sites/$site/files/files/downloads", 0777, true);
        mkdir($this->www."/sites/$site/files/files/images", 0777, true);

        `chmod -R 0777 $this->www/sites/$site/files`;
    }

    public function createDatabase()
    {
        $result = `echo 'SHOW DATABASES LIKE "$this->database"' | mysql -upolice -ppolice`;
        if (!empty($result))
        {
            $this->out("Database table exists.\nRun 'police reinstall' if you would like to re-create it");

            return;
        }

        $result = shell_exec("echo 'CREATE DATABASE `$this->database` CHARACTER SET utf8' | mysql -upolice -ppolice");
        if (!empty($result)) { // MySQL returned an error
            throw new \Exception(sprintf('Cannot create database %s. Error: %s', $this->database, $result));
        }

        $dir = $this->www.'/install/custom/mysql';

        foreach (self::$files as $file)
        {
            $result = `mysql -ppolice -upolice $this->database < $dir/$file`;
            if (!empty($result)) { // MySQL returned an error
                throw new \Exception(sprintf('Cannot import file %s. Error: %s', $file, $result));
            }
        }
    }

    public function setupMapping()
    {
        foreach (glob($this->www.'/install/custom/elasticsearch/*.mapping') as $mapping) {
            `/bin/bash $mapping`;
        }
    }

    public function deleteDatabase()
    {
        $result = shell_exec("echo 'DROP DATABASE IF EXISTS `$this->database`' | mysql -upolice -ppolice");
        if (!empty($result)) { // MySQL returned an error
            throw new \Exception(sprintf('Cannot delete database %s. Error: %s', $this->database, $result));
        }
    }

    public function deleteIndices()
    {
        `curl -s -XDELETE 'http://localhost:9200/*/'`;
    }

    public function deleteFiles()
    {
        `cd $this->www && git reset --hard HEAD`;
        `cd $this->www && git clean -d -x -f`;

        foreach (array('9999', 'default') as $site)
        {
            $path = $this->www.'/sites/'.$site.'/';

            if (file_exists($path))
            {
                `rm -rf $path`;
            }
        }
    }

    public function modifyConfiguration()
    {
        $input    = $this->www.'/config/config.php-dist';
        $output   = $this->www.'/config/config.php';

        $contents = file_get_contents($input);
        $replace  = function($name, $value) use(&$contents) {
            $pattern     = sprintf("#%s = '.*?'#", $name);
            $replacement = sprintf("%s = '%s'", $name, $value);

            $contents = preg_replace($pattern, $replacement, $contents);
        };

        $replace('sendmail', '/usr/bin/env catchmail');
        $replace('theme', 'mobile');
        $replace('user', 'police');
        $replace('password', 'police');
        $replace('db', $this->database);

        $replace('mailer', 'smtp');
        $replace('smtphost', 'localhost');
        $replace('smtpport', 1025);
        $replace('mailfrom', 'policebox@localhost.home');
        $replace('fromname', 'Police Box');

        file_put_contents($output, $contents);
        chmod($output, 0644);
    }

    public function runComposer()
    {
        $this->out('Installing dependencies via Composer');
        $output = `cd $this->www; composer --no-interaction install`;
    }

    public function runPhpmig()
    {
        $this->out('Installing Phpmig dependencies via Composer');
        $output = `cd $this->www/scripts/phpmig; composer --no-interaction install`;

        $config = $this->www.'/scripts/phpmig/config.php';
        if(!file_exists($config))
        {
            $contents = file_get_contents($this->www.'/scripts/phpmig/config.php-example');
            $contents = preg_replace('/\$this\->host = \$config\->host/', "\$this->host = '127.0.0.1'", $contents);

            file_put_contents($config, $contents);
            chmod($config, 0644);
        }

        $this->out('Executing Phpmig migrations');
        $output = `cd $this->www/scripts/phpmig; bin/phpmig migrate`;
    }

    public function out($text = '', $nl = true)
    {
        fwrite(STDOUT, $text . ($nl ? "\n" : null));

        return $this;
    }

    public function error($text = '', $nl = true)
    {
        fwrite(STDERR, $text . ($nl ? "\n" : null));

        return $this;
    }
}
