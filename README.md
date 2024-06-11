![Wago Logo](wago-logo.png)

[![Packagist](https://img.shields.io/packagist/v/cresenity/wago-php.svg)](https://packagist.org/packages/cresenity/wago-php)
[![Downloads](https://img.shields.io/packagist/dt/cresenity/wago-php.svg?maxAge=3600)](https://packagist.org/packages/cresenity/wago-php)
[![MIT licensed](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![GitHub contributors](https://img.shields.io/github/contributors/cresenity/wago-php.svg)](https://github.com/cresenity/wago-php/graphs/contributors)


**This library allows you to quickly and easily use the Wago Web API via PHP.**

## Install Package

`composer require cresenity/wago-php`

## Usage

```php
<?php
use Cresenity\Vendor\Wago\Wago;

$wago = Wago::device('your-device-api-token');

$wago->sendMessage('081xxxx', 'Hello');
```

## Documentation

[Wago Documentation](https://wa-go.id/docs/api/device)


# License
[The MIT License (MIT)](LICENSE)
