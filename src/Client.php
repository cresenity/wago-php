<?php

namespace Cresenity\Vendor\Wago;

use Cresenity\Vendor\Wago\AdapterInterface;

class Client {
    /**
     * @var \Cresenity\Vendor\Wago\AdapterInterface
     */
    protected $adapter;

    protected $baseUri;

    public function __construct(AdapterInterface $adapter, $baseUri) {
        $this->adapter = $adapter;

        $this->baseUri = $baseUri;
    }

    public function url($method, $queries = null) {
        $url = $this->baseUri . $method;
        $queryString = '';
        if ($queries != null) {
            if (is_string($queryString)) {
                $queryString = $queries;
            }
            if (is_array($queries)) {
                if (count($queries) > 0) {
                    $queryString = self::asPostString($queryString);
                }
            }
            if (strlen($queryString) > 0) {
                $url .= '?' . $queryString;
            }
        }

        return $url;
    }

    public function get($method, $parameters = null, $headers = null) {
        $url = $this->url($method, is_string($parameters) ? $parameters : null);
        $response = $this->adapter->get($url, is_array($parameters) ? $parameters : null, $headers);
        $result = json_decode($response, true);

        return $result;
    }

    public function post($method, $parameters = null, $headers = null) {
        $url = $this->url($method);
        $response = $this->adapter->post($url, $parameters, $headers);

        return $response;
    }

    public function put($method, $parameters = null, $headers = null) {
        $url = $this->url($method);

        $response = $this->adapter->put($url, $parameters, $headers);

        return $response;
    }

    public function delete($method, $parameters = null, $headers = null) {
        $url = $this->url($method);
        $response = $this->adapter->delete($url, $parameters, $headers);
        $result = json_decode($response, true);

        return $result;
    }

    /**
     * @param string      $val
     * @param null|string $key pass null to no key
     *
     * @return string
     */
    private static function asPostString($val, $key = null) {
        $result = '';
        $prefix = $key;

        if (is_array($val)) {
            foreach ($val as $k => $v) {
                if ($prefix === null) {
                    $result .= '&' . static::asPostString($v, $k);
                } else {
                    $result .= '&' . static::asPostString($v, $prefix . '[' . $k . ']');
                }
            }
        } else {
            $encoded_val = urlencode($val);
            if (isset($val[0]) && $val[0] == '@') {
                //$encoded_val = '@' . urlencode(substr($val, 1));
                $encoded_val = $val;
            }
            $result .= '&' . urlencode((string) $prefix) . '=' . $encoded_val;
        }

        $result = substr($result, 1);

        return $result;
    }
}
