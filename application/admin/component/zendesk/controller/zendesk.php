<?php
/**
 * Belgian Police Web Platform - Zendesk Component
 *
 * @copyright	Copyright (C) 2012 - 2017 Timble CVBA. (http://www.timble.net)
 * @license		GNU AGPLv3 <https://www.gnu.org/licenses/agpl.html>
 * @link		https://github.com/timble/openpolice-platform
 */

use Nooku\Library;

class ZendeskControllerZendesk extends Library\ControllerView
{
    public function _actionRender(Library\CommandContext $context)
    {
        $application    = $this->getObject('application');
        $user           = $this->getUser();

        if($user->getRole() < 24)
        {
            $url = clone($context->request->getUrl());
            $url->query['option'] = 'com_dashboard';

            $this->getObject('application')->getRouter()->build($url);

            return $this->getObject('component')->redirect($url);
        }

        require_once(JPATH_VENDOR . '/firebase/php-jwt/Firebase/PHP-JWT/Authentication/JWT.php');

        $key       = $application->getCfg('api_zendesk');
        $now       = time();

        $token = array(
            "jti"   => md5($now . rand()),
            "iat"   => $now,
            "name"  => $user->getName(),
            "email" => $user->getEmail()
        );

        $jwt = JWT::encode($token, $key);

        $url = 'https://police.zendesk.com/access/jwt?jwt=' . $jwt;

        return $this->getObject('component')->redirect($url);
    }
}