<?php

namespace Cresenity\Vendor\Wago;

use Cresenity\Vendor\Wago\Adapter\GuzzleAdapter;
use Cresenity\Vendor\Wago\Exception\ApiException;

class Device {
    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $baseUri;

    /**
     * @var \Cresenity\Vendor\Wago\Client
     */
    protected $client;

    public function __construct($token, $options = []) {
        $this->token = $token;
        $this->baseUri = $options['baseUri'] ?? 'https://wa-go.id/api/device/';
        $this->client = new Client(new GuzzleAdapter($options + ['token' => $this->token]), $this->baseUri);
    }

    /**
     * @param string $phone
     * @param string $message
     * @param array  $options
     *
     * @throws \Cresenity\Vendor\Wago\Exception\ApiException
     * @throws \Cresenity\Vendor\Wago\Exception\HttpException
     *
     * @return array
     */
    public function sendMessage($phone, $message, array $options = []) {
        $request = [
            'phone' => $phone,
            'message' => $message,
        ];
        $imageUrl = $options['imageUrl'] ?? null;
        $documentUrl = $options['documentUrl'] ?? null;
        $mimeType = $options['mimeType'] ?? null;
        $fileName = $options['fileName'] ?? null;
        $scheduleAt = $options['scheduleAt'] ?? null;
        if ($imageUrl) {
            $request['imageUrl'] = $imageUrl;
        }
        if ($documentUrl) {
            $request['documentUrl'] = $documentUrl;
        }
        if ($mimeType) {
            $request['mimeType'] = $mimeType;
        }
        if ($fileName) {
            $request['fileName'] = $fileName;
        }
        if ($scheduleAt) {
            $request['scheduleAt'] = $scheduleAt;
        }

        return $this->handleResponse($this->client->post('message/send', $request));
    }

    /**
     * @return array
     */
    public function getInfo() {
        return $this->handleResponse($this->client->get('info'));
    }

    /**
     * @return array
     */
    public function getStatus() {
        return $this->handleResponse($this->client->get('status'));
    }

    public function getWebhook() {
        return $this->handleResponse($this->client->get('webhook/get'));
    }

    public function unsetWebhook() {
        return $this->handleResponse($this->client->post('webhook/unset'));
    }

    public function setWebhook($url) {
        $options = [
            'endpoint' => $url
        ];

        return $this->handleResponse($this->client->post('webhook/set', $options));
    }

    /**
     * @param mixed $response
     *
     * @return array
     */
    public function handleResponse($response) {
        if (is_string($response)) {
            $response = json_decode($response, true);
        }
        $errCode = (int) ($response['errCOde'] ?? null);
        if ($errCode != 0) {
            $errMessage = $response['errMessage'] ?? null;

            throw new ApiException($errMessage);
        }

        return $response['data'] ?? [];
    }

    public function getClient() {
        return $this->client;
    }
}
