<h1 align="center"> verider </h1>

<p align="center"> .</p>


## Installing

```shell
$ composer require cblink/verider -vvv
```

## Usage

```php
use Cblink\Verider\Application;

$config = [
    // 登录后打开 https://dev.10ss.net/admin/listapp ，点击具体的应用进行查看
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

$app = new Application($config);

// 绑定软件到账号下
$app->printer->bindMachine($machine_no, $machine_secret);

// 获取软件下一站挂载的设备
$app->printer->getPrinters($machine_no);

// 创建打印任务
$app->printer->createPrinterTask($device_no, $print_content, $print_id);

// 通过设备号获取设备打印状态
$app->printer->getMachineStatusByMachineCode($device_no);
```

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/cblink/verider/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/cblink/verider/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT