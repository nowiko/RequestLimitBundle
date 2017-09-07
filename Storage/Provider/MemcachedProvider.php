<?php

namespace NV\RequestLimitBundle\Storage\Provider;

use NV\RequestLimitBundle\Storage\Provider\ProviderInterface;

class MemcachedProvider implements ProviderInterface
{
    /**
     * @var \Memcached $_memcached
     */
    private $_memcached;

    /**
     * @param $configuration
     */
    public function configure($configuration)
    {
        $memcachedHost = $configuration['server'];
        $memcachedPort = $configuration['port'];

        $_memcached = new \Memcached();
        $_memcached->addServer($memcachedHost, $memcachedPort);
    }

    /**
     * @inheritdoc
     */
    public function get($key)
    {
       return $this->_memcached->get($key);
    }

    /**
     * @inheritdoc
     */
    public function set($key, $expiresAt)
    {
        return $this->_memcached->set($key, $expiresAt, 60 * 60 * 24 * 30);
    }

}
