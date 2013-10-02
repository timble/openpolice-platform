<?php
/**
 * Belgian Police Web Platform - Zendesk Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

use Nooku\Library;

class ZendeskControllerZendesk extends Library\ControllerView
{
    public function _actionRender(Library\CommandContext $context)
    {
        $user           = $this->getUser();

        if($user->getRole() < 24) {
            $url = clone($context->request->getUrl());
            $url->query['option'] = 'com_dashboard';

            $this->getObject('application')->getRouter()->build($url);

            return $this->getObject('component')->redirect($url);
        }

        require_once(JPATH_VENDOR . '/firebase/php-jwt/Firebase/PHP-JWT/Authentication/JWT.php');

        $key       = "4DbI0vrQfmQqhZuIAp6NapeI92kEL8CJpb2n4vIT0aGeGiu0";
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