<?php

namespace NW\RequestLimitBundle\Exception;

use Throwable;

/**
 * Class RequestLimitReachedException
 * @package NW\RequestLimitBundle\Exception
 * @author Novikov Viktor
 */
class RequestLimitReachedException extends \Exception
{
    /**
     * {@inheritdoc}
     */
    public function __construct(
        $message = "You reached the defined requests limit. Please, try again later.",
        $code = 403,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
