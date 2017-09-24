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

    /**
     * @param StorageManager $storageManager
     */
    public function __construct(StorageManager $storageManager)
    {
        $this->storageManager = $storageManager;
    }

    public function restrictRequestByIp($userIp)
    {
        return $this->restrictByKey($userIp);
    }

    public function restrictRequestByUserId($userId)
    {
       return $this->restrictByKey($userId);
    }

    /**
     * @param $key
     * @return mixed
     * @throws RequestLimitReachedException
     */
    private function restrictByKey($key) {
        if ($this->storageManager->hasItem($key)) {
            throw new RequestLimitReachedException();
        }

        $this->storageManager->setItem($key);

        return $this->storageManager->getItem($key);
    }
}
