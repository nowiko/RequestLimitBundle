<?php

namespace NV\RequestLimitBundle\Utils;

use NV\RequestLimitBundle\Exception\RequestLimitReachedException;
use NV\RequestLimitBundle\Storage\StorageManager;

class RequestRestrictor
{
    /**
     * @var StorageManager
     */
    private $storageManager;

    public function __construct($storageManager)
    {
        $this->storageManager = $storageManager;
    }

    public function restrictPostRequestByIp($userIp)
    {
        return $this->restrictByKey($userIp);
    }

    public function restrictPostRequestByUserId($userId)
    {
       return $this->restrictByKey($userId);
    }

    private function restrictByKey($key) {
        if ($this->storageManager->hasItem($key)) {
            throw new RequestLimitReachedException();
        }

        $this->storageManager->setItem($key);

        return $this->storageManager->getItem($key);
    }
}
