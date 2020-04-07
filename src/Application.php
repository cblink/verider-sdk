<?php

namespace Cblink\Verider;

use Cblink\Verider\Printer\Printer;
use Mouyong\Foundation\Foundation;
use Cblink\Verider\Printer\PrinterServiceProvider;

/**
 * Class Application
 * @package Cblink\Verider
 * @property-read Printer $printer
 */
class Application extends Foundation
{
    protected $config = [
        'open_user_id' => 'your-client-id',
        'open_user_secret' => 'your-client-secret',

        'log' => [
            'name' => 'verider',
        ],
        'http' => [
            'timeout' => 3,
            'base_uri' => 'http://rcloud.verysum.com:8088',
            'http_errors' => false,
            'headers' => [
                'content-type' => 'application/json',
                'accept' => 'application/json',
            ],
        ],
        'cache' => [
            'namespace' => 'verider',
        ],
    ];

    protected $providers = [
        PrinterServiceProvider::class,
    ];
}