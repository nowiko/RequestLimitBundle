<?php

namespace NV\RequestLimitBundle\Storage;


class StorageManager
{
    private $provider;

    public function __construct()
    {
    }


    public function hasItem($key)
    {
        if ($this->provider->get($key)) {
            return true;
        }

        return false;
    }

    public function getItem($key)
    {
        return $this->provider->get($key);
    }


    public function setItem($key, $value = null)
    {
        $value = $value ? : new \DateTime('now');
        $this->provider->set($key, $value);
    }
}
