<?php

namespace NV\RequestLimitBundle\Storage\Provider;

use Doctrine\ORM\EntityManager;
use NV\RequestLimitBundle\Storage\Provider\ProviderInterface;

class MySQLProvider implements ProviderInterface
{
    /**
     * @var EntityManager $_em
     */
    private $_em;


    public function __construct($em)
    {
        $this->_em = $em;
    }

    /**
     * @param $configuration
     */
    public function configure($configuration)
    {
    }

    /**
     * @inheritdoc
     */
    public function get($key)
    {
       // @TODO implement
    }

    /**
     * @inheritdoc
     */
    public function set($key, $expiresAt)
    {
        // @TODO implement
    }

    /**
     * @inheritdoc
     */
    public function remove($key)
    {
        // @TODO implement
    }
}
