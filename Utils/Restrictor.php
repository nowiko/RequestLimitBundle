<?php

namespace NV\RequestLimitBundle\Utils;

use NV\RequestLimitBundle\Exception\RequestLimitReachedException;
use NV\RequestLimitBundle\Storage\StorageManager;

/**
 * Class Restrictor
 * @package NV\RequestLimitBundle\Utils
 * @author Novikov Viktor
 */
class Restrictor
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

    /**
     * @param $artifact
     * @return mixed
     * @throws RequestLimitReachedException
     */
    public function blockBy($artifact)
    {
        if ($this->storageManager->hasItem($artifact)) {
            throw new RequestLimitReachedException();
        }
        $this->storageManager->setItem($artifact);

        return $this->storageManager->getItem($artifact);
    }
}
