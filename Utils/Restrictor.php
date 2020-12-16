<?php

namespace NW\RequestLimitBundle\Utils;

use NW\RequestLimitBundle\Exception\RequestLimitReachedException;
use NW\RequestLimitBundle\Storage\StorageManager;

/**
 * Class Restrictor
 * @package NW\RequestLimitBundle\Utils
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
