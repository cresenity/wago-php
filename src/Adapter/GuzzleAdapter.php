<?php

namespace Cresenity\Vendor\Wago\Adapter;

use Monolog\Logger;
use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\MessageFormatter;
use Monolog\Handler\RotatingFileHandler;
use GuzzleHttp\Exception\RequestException;
use Cresenity\Vendor\Wago\AdapterInterface;
use Cresenity\Vendor\Wago\Exception\ApiException;
use Cresenity\Vendor\Wago\Exception\HttpException;
use Cresenity\Vendor\Wago\Exception\InvalidTokenException;

class GuzzleAdapter implements AdapterInterface {
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Response
     */
    protected $response;

    protected $token;

    protected $isLog;

    protected $logPath;

    /**
     * @param mixed $options
     */
    public function __construct(array $options = []) {
        $this->isLog = $options['logging'] ?? false;
        $this->logPath = $options['logPath'] ?? null;
        $this->token = $options['token'] ?? null;
        $options = [];

        if ($this->isLog) {
            $messageFormats = [
                'REQUEST: {method} - {uri} - HTTP/{version} - {req_headers} - {req_body}',
                'RESPONSE: {code} - {res_body}',
            ];

            $stack = HandlerStack::create();
            foreach ($messageFormats as $messageFormat) {
                $logger = new Logger('guzzle-log');
                // We'll use unshift instead of push, to add the middleware to the bottom of the stack, not the top
                $stack->unshift(
                    Middleware::log(
                        $logger->pushHandler(
                            new RotatingFileHandler($this->logPath)
                        ),
                        new MessageFormatter($messageFormat)
                    )
                );
            }

            $options['handler'] = $stack;
        }
        $client = new Client($options);

        $this->client = $client;
    }

    protected function getDefaultOptions() {
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->token,
                'Content-Type' => 'application/json',
            ]
        ];

        return $options;
    }

    /**
     * @inheritdoc
     */
    public function get($url, $query = null, $headers = null) {
        try {
            $options = $this->getDefaultOptions();

            if ($query != null && is_array($query)) {
                $options['query'] = $query;
            }

            $this->response = $this->client->get($url, $options);
        } catch (RequestException $e) {
            $this->response = $e->getResponse();
            $this->handleError($e);
        }

        return (string) $this->response->getBody();
    }

    /**
     * @inheritdoc
     */
    public function delete($url, $content = '', $headers = null) {
        try {
            $options = $this->getDefaultOptions();
            $options[is_array($content) ? 'json' : 'body'] = $content;
            $this->response = $this->client->delete($url, $options);
        } catch (RequestException $e) {
            $this->response = $e->getResponse();
            $this->handleError($e);
        }

        return (string) $this->response->getBody();
    }

    /**
     * @inheritdoc
     */
    public function postMultiPart($url, $content) {
        try {
            $options = $this->getDefaultOptions();
            $options['multipart'] = $content;
            if (isset($options['headers']['Content-Type'])) {
                //we wil unset this
                unset($options['headers']['Content-Type']);
            }

            $this->response = $this->client->request('POST', $url, $options);
        } catch (RequestException $e) {
            $this->response = $e->getResponse();
            $this->handleError($e);
        }

        return (string) $this->response->getBody();
    }

    /**
     * @inheritdoc
     */
    public function put($url, $content = '', $headers = null) {
        $options = $this->getDefaultOptions();

        $options[is_array($content) ? 'json' : 'body'] = $content;

        try {
            $this->response = $this->client->put($url, $options);
        } catch (RequestException $e) {
            $this->response = $e->getResponse();
            $this->handleError($e);
        }

        return (string) $this->response->getBody();
    }

    /**
     * @inheritdoc
     */
    public function post($url, $content = '', $headers = null) {
        $options = $this->getDefaultOptions();
        $options[is_array($content) ? 'json' : 'body'] = $content;

        try {
            $this->response = $this->client->post($url, $options);
        } catch (RequestException $e) {
            $this->response = $e->getResponse();
            $this->handleError($e);
        }

        return (string) $this->response->getBody();
    }

    /**
     * @param mixed $e
     *
     * @throws \Cresenity\Vendor\Wago\Exception\HttpException
     * @throws \Cresenity\Vendor\Wago\Exception\ApiException
     * @throws \Cresenity\Vendor\Wago\Exception\InvalidTokenException
     */
    protected function handleError($e) {
        if ($this->response == null) {
            throw $e;
        }
        $body = (string) $this->response->getBody();
        $code = (int) $this->response->getStatusCode();
        if ($code != 200) {
            if ($code == 401) {
                $content = json_decode($body, true);
                $errMessage = $content['errMessage'] ?? null;
                if ($errMessage == 'Token Not Found or Invalid Token') {
                    throw new InvalidTokenException($errMessage);
                }
            }

            throw new HttpException(isset($body) ? $body : 'Request not processed.', $code);
        }
        $content = json_decode($body);

        throw new ApiException(isset($content->message) ? $content->message : 'Request not processed.', $code);
    }
}
