<?php

namespace Cblink\Verider\Test;

use Cblink\Verider\Application;

class ApplicationTest extends TestCase
{
    /** @test */
    public function services()
    {
        $app = new Application();

        $baseServices = [
            'options' => \Mouyong\Foundation\Collection::class,
            'cache' => \Symfony\Component\Cache\Adapter\FilesystemAdapter::class,
            'log' => \Monolog\Logger::class,
            'request' => \Symfony\Component\HttpFoundation\Request::class,
            'http' => \GuzzleHttp\Client::class,
        ];

        $services = array_merge($baseServices, [
            'printer' => \Cblink\Verider\Printer\Printer::class,
        ]);

        $this->assertCount(count($services), $app->keys());
        foreach ($services as $name => $service) {
            $this->assertInstanceof($service, $app->{$name});
            $this->assertInstanceof($service, $app[$name]);
        }
    }
}