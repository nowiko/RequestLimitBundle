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
        $connection = $this->_em->getConnection();
        $statement = $connection->exec(
    'SELECT expires_at FROM nv_request_limit_items
               WHERE item_key = :item_key'
        );
        $statement->bindParam('item_key', $key);
        $result = $statement->fetchAll(\PDO::FETCH_COLUMN);
        $connection->close();

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function set($key, $expiresAt)
    {
        $connection = $this->_em->getConnection();
        $statement = $connection->exec(
            'INSERT INTO nv_request_limit_items (item_key, expires_at) VALUES item_key = :item_key, expires_at = :expires_at'
        );
        $statement->bindParam('item_key', $key);
        $statement->bindParam('expires_at', $key);
        $connection->close();
    }

    /**
     * @inheritdoc
     */
    public function remove($key)
    {
        // @TODO implement
    }
}
