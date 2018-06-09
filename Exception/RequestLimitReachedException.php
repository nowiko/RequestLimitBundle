<?php

namespace NV\RequestLimitBundle\Exception;

use Throwable;

class RequestLimitReachedException extends \Exception
{
    /**
     * @inheritdoc
     */
    public function __construct($message = "You reached defined requests limit, please try again later", $code = 403, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
