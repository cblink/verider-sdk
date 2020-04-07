<?php

namespace Cblink\Verider\Exceptions;

class AccessTokenExpireException extends Exception
{
    protected $code = 18;

    const CODE = 18;
}