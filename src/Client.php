<?php

namespace Cblink\Verider;

use Mouyong\Foundation\AbstractClient;
use Mouyong\Foundation\Contracts\ApiContract;
use Cblink\Verider\Exceptions\VeriderApiException;
use Cblink\Verider\Exceptions\AccessTokenExpireException;
use Cblink\Verider\Exceptions\MethodRetryTooManyException;

class Client extends AbstractClient implements ApiContract
{
    public function sign(array $data = []): array
    {
        $data['open_user_id'] = $this->app['options']['open_user_id'];
        $data['open_user_secret'] = $this->app['options']['open_user_secret'];

        $data['timestamp'] = time();
        $data['nonce'] = uniqid();

        $tmpSignArr = ['open_user_secret' => $data['open_user_secret'], 'nonce' => $data['nonce'], 'timestamp' => $data['timestamp']];

        ksort($tmpSignArr);

        $joinStr = implode($tmpSignArr);

        $sha1Str = sha1($joinStr);

        $data['signature'] = $sha1Str;

        unset($data['open_user_secret']);

        return $data;
    }

    public function request(string $method, string $uri, array $options = [], $retry = 1)
    {
        if ($retry === -1) {
            throw new MethodRetryTooManyException("In SDK: uri: {$uri} 重试次数过多", AccessTokenExpireException::CODE);
        }

        try {
            $rsp = $this->getClient()->request($method, $uri, $options);
        } catch (\Throwable $e) {
            $this->app->log->error("请求出现错误 code: {$e->getCode()} message: {$e->getMessage()}");
            throw new VeriderApiException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }

        try {
            return $this->castResponseToType($rsp);
        } catch (\Throwable $e) {
            $this->app->log->error("转换响应信息出现错误 error: {$e->getCode()} error_description: {$e->getMessage()} , request data ", $options);
            throw $e;
        }
    }

    public function castResponseToType($rsp)
    {
        $data = json_decode($rsp->getBody()->getContents(), true);

        if (empty($data)) {
            $this->app->log->error('响应数据为空');

            throw new VeriderApiException('响应数据为空', 500);
        }

        if (isset($data['code']) && intval($data['code']) !== 0) {

            throw new VeriderApiException($data['error'], $data['code']);
        }

        $this->app->log->info('响应信息', $data);


        return $data;
    }
}