<?php

namespace Cresenity\Vendor\Wago;

use Cresenity\Vendor\Wago\Device;

class Wago {
    /**
     * @param null|string $token
     * @param array       $options
     *
     * @return \Cresenity\Vendor\Wago\Device
     */
    public static function device($token = null, $options = []) {
        return new Device($token, $options);
    }
}
