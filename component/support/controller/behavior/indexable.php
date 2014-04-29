<?php
/**
 * Belgian Police Web Platform - Support Component
 *
 * @copyright	Copyright (C) 2012 - 2014 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Support;

use Nooku\Library;
use Nooku\Component\Slack;

class ControllerBehaviorIndexable extends Library\ControllerBehaviorAbstract
{
    protected function _afterControllerAdd(Library\CommandContext $context)
    {
        $entity = $context->result;

        $data = $entity->toArray();
        $data['zone'] = $this->getObject('application')->getSite();

        $document = json_encode($data);

        $endpoint = 'http://127.0.0.1:9200/support/'.$entity->getIdentifier()->name.'/'.$entity->id;

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL            => $endpoint,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_TIMEOUT        => 5,
            CURLOPT_HTTPHEADER     => array('Content-Type: text/plain'),
            CURLOPT_CUSTOMREQUEST  => 'PUT',
            CURLOPT_FORBID_REUSE   => 0,
            CURLOPT_POSTFIELDS     => $document
        ));

        $response = curl_exec($ch);

        if(curl_errno($ch)) {
            throw new \RuntimeException('Failed to store document in Elasticsearch cluster: '.curl_error($ch));
        }

        curl_close($ch);
    }
}