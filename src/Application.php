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
        'debug' => false,
        'open_user_id' => 'your-client-id',
        'open_user_secret' => 'your-client-secret',

        'log' => [
            'name' => 'verider',
        ],
        'http' => [
            'response_type' => 'array', // array, raw
            'timeout' => 3,
            'base_uri' => 'https://api.open.veryclub.net',
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