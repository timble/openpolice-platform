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

        if ($entity->getStatus() == Library\Database::STATUS_CREATED)
        {
            $data = $entity->toArray();
            $data['zone'] = $this->getObject('application')->getSite();

            $document = json_encode($data);

            $endpoint = 'http://127.0.0.1:9200/support/'.$entity->getIdentifier()->name.'/'.$entity->id;

            $this->_put($endpoint, $document);
        }
    }

    protected function _afterControllerEdit(Library\CommandContext $context)
    {
        $entity = $context->result;

        if ($entity->getStatus() == Library\Database::STATUS_UPDATED)
        {
            $data = $entity->toArray();
            $data['zone'] = $this->getObject('application')->getSite();

            $document = json_encode($data);

            $endpoint = 'http://127.0.0.1:9200/support/'.$entity->getIdentifier()->name.'/'.$entity->id;

            $this->_put($endpoint, $document);
        }
    }

    protected function _afterControllerDelete(Library\CommandContext $context)
    {
        $entity = $context->result;

        if ($entity->getStatus() == Library\Database::STATUS_DELETED)
        {
            $endpoint = 'http://127.0.0.1:9200/support/'.$entity->getIdentifier()->name.'/'.$entity->id;

            $this->_delete($endpoint);
        }
    }

    protected function _put($endpoint, $document)
    {
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

    protected function _delete($endpoint)
    {
        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL            => $endpoint,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_TIMEOUT        => 5,
            CURLOPT_HTTPHEADER     => array('Content-Type: text/plain'),
            CURLOPT_CUSTOMREQUEST  => 'DELETE',
            CURLOPT_FORBID_REUSE   => 0
        ));

        $response = curl_exec($ch);

        if(curl_errno($ch)) {
            throw new \RuntimeException('Failed to store document in Elasticsearch cluster: '.curl_error($ch));
        }

        curl_close($ch);
    }
}