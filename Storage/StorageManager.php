<?php

namespace NV\RequestLimitBundle\Storage;

use NV\RequestLimitBundle\Storage\Provider\ProviderInterface;

class StorageManager
{
    /**
     * @var ProviderInterface
     */
    public $provider;

    /**
     * @param $provider
     */
    public function setProvider(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @param $key
     * @return bool
     */
    public function hasItem($key)
    {
        return ($this->provider->get($key) && $this->stillRestricted($key)) ? true : false;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getItem($key)
    {
        return $this->provider->get($key);
    }

    /**
     * @param $key
     * @param null $value
     */
    public function setItem($key, $value = null)
    {
        $value = $value ?: new \DateTime('+ 10 minutes');
        $this->provider->set($key, $value->getTimestamp());
    }

    /**
     * @param $key
     */
    public function removeItem($key)
    {
        $this->provider->remove($key);
    }

    /**
     * @return int
     */
    public function getItemsCount()
    {
        return $this->provider->getItemsCount();
    }

    /**
     * @return array
     */
    public function fetchAllItems()
    {
        return $this->provider->fetchAllItems();
    }

    /**
     * @param $key
     * @return bool
     */
    private function stillRestricted($key)
    {
        $timestamp        = $this->provider->get($key);
        $currentDate      = new \DateTime();
        $currentTimestamp = $currentDate->getTimestamp();

        if ($timestamp < $currentTimestamp) {
            $this->removeItem($key);
            return false;
        }

        return true;
    }
}
