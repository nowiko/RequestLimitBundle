<?php

namespace NV\RequestLimitBundle\Utils;

use NV\RequestLimitBundle\Exception\RequestLimitReachedException;

class RequestRestrictor
{
    private $storageManager;

    public function __construct($storageManager)
    {
        $this->storageManager = $storageManager;
    }

    public function restrictPostRequestByIp($userIp)
    {
        $this->restrictByKey($userIp);
    }

    public function restrictPostRequestByUserId($userId)
    {
       $this->restrictByKey($userId);
    }

    private function restrictByKey($key) {
        if ($this->storageManager->hasItem($key)) {
            throw new RequestLimitReachedException();
        }

        $this->storageManager->setItem($key);
    }
}
