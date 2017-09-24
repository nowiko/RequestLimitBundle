<?php

namespace NV\RequestLimitBundle\Storage;


class StorageManager
{
    private $provider;

    public function setProvider($provider)
    {
        $this->provider = $provider;
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
        $value = $value ? : new \DateTime('+ 10 minutes');
        $this->provider->set($key, $value);
    }
}
