<?php

namespace Cresenity\Vendor\Wago;

interface AdapterInterface {
    /**
     * @param string     $url
     * @param null|mixed $query
     * @param null|mixed $headers
     *
     * @throws \Cresenity\Vendor\Wago\Exception\HttpException
     *
     * @return string
     */
    public function get($url, $query = null, $headers = null);

    /**
     * @param string     $url
     * @param mixed      $parameters
     * @param null|mixed $headers
     *
     * @throws \Cresenity\Vendor\Wago\Exception\HttpException
     */
    public function delete($url, $parameters, $headers = null);

    /**
     * @param string       $url
     * @param array|string $content
     * @param null|mixed   $headers
     *
     * @throws \Cresenity\Vendor\Wago\Exception\HttpException
     *
     * @return string
     */
    public function put($url, $content = '', $headers = null);

    /**
     * @param string       $url
     * @param array|string $content
     * @param null|mixed   $headers
     *
     * @throws \Cresenity\Vendor\Wago\Exception\HttpException
     *
     * @return string
     */
    public function post($url, $content = '', $headers = null);
}
