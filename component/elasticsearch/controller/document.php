<?php
namespace Nooku\Component\Elasticsearch;

use Nooku\Library;

class ControllerDocument extends Library\ControllerAbstract
{
    protected $_scheme = 'http';
    protected $_host   = '127.0.0.1';
    protected $_port   = '9200';

    protected function _actionBrowse(Library\CommandContext $context)
    {
        $result = false;

        if (isset($context->index) && isset($context->type))
        {
            $method   = 'GET';
            $endpoint = '/' . $context->index . '/' . $context->type . '/_search';

            $payload = array();
            if ($context->query) {
                $payload['query'] = $context->query;
            }

            if ($context->sort) {
                $payload['sort'] = $context->sort;
            }

            $response = $this->_request($endpoint, $method, $payload);

            $result = $response->hits;
        }
        else throw new ControllerExceptionBadRequest('Missing index and/or type.');

        return $result;
    }

    protected function _actionAdd(Library\CommandContext $context)
    {
        if (isset($context->index) && isset($context->type))
        {
            $document = $context->document;

            $method   = 'POST';
            $endpoint = '/' . $context->index . '/' . $context->type;

            if (isset($document->id))
            {
                $method   = 'PUT';
                $endpoint .= '/' . $document->id;

                unset($document->id);
            }

            $payload = Library\ObjectConfig::unbox($document);

            if (!count($payload)) {
                throw new Library\ControllerExceptionBadRequest('Missing document body');
            }

            $this->_request($endpoint, $method, $payload);
        }
        else throw new ControllerExceptionBadRequest('Missing index and/or type.');

        return true;
    }

    protected function _actionEdit(Library\CommandContext $context)
    {
        return $this->_actionAdd($context);
    }

    protected function _actionDelete(Library\CommandContext $context)
    {
        if (isset($context->index) && isset($context->type))
        {
            if (!$context->id) {
                throw new Library\ControllerExceptionBadRequest('Missing document ID');
            }

            $method   = 'DELETE';
            $endpoint = '/' . $context->index . '/' . $context->type . '/' . $context->id;

            $this->_request($endpoint, $method);
        }
        else throw new ControllerExceptionBadRequest('Missing index and/or type.');

        return true;
    }

    protected function _request($endpoint, $method = 'GET', array $payload = array())
    {
        $ch = curl_init();

        $url = $this->getObject('lib:http.url')
                    ->setScheme($this->_scheme)
                    ->setHost($this->_host)
                    ->setPort($this->_port)
                    ->setPath($endpoint);

        curl_setopt_array($ch, array(
            CURLOPT_URL            => $url->toString(),
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_TIMEOUT        => 5,
            CURLOPT_HTTPHEADER     => array('Content-Type: text/plain'),
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_FORBID_REUSE   => 0
        ));

        if (count($payload))
        {
            $body = json_encode($payload);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }

        $response = curl_exec($ch);

        if(curl_errno($ch)) {
            throw new Library\ControllerExceptionActionFailed('Failed to query Elasticsearch cluster: '.curl_error($ch));
        }

        curl_close($ch);

        $result = json_decode($response);

        if (isset($result->error) && $result->status != 200) {
            throw new Library\ControllerExceptionActionFailed('Elasticsearch returned an error: '.$result->error);
        }

        return $result;
    }
}
 