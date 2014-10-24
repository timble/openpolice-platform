<?php
namespace Nooku\Cli;

use Nooku\Library;

class UserSessionCli extends Library\UserSession
{
    public function isActive()
    {
        return false;
    }
}