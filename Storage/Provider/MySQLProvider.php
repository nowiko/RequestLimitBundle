<?php

namespace NV\RequestLimitBundle\Storage\Provider;

use Doctrine\ORM\EntityManager;

class MySQLProvider implements ProviderInterface
{
    /**
     * @var EntityManager $_em
     */
    private $_em;

    /**
     * @param EntityManager $em
     */
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
        $statement  = $connection->prepare('SELECT expires_at FROM nv_request_limit_items WHERE item_key = :item_key');
        $statement->bindValue('item_key', $key);
        $statement->execute();
        $result     = $statement->fetchAll(\PDO::FETCH_COLUMN);
        $connection->close();
        $date       = \DateTime::createFromFormat('Y-m-d H:i:s', $result[0]);

        return $date->getTimestamp();
    }

    /**
     * @inheritdoc
     */
    public function set($key, $expiresAt)
    {
        $connection = $this->_em->getConnection();
        $statement  = $connection->prepare(
            'INSERT INTO nv_request_limit_items (item_key, expires_at) VALUES (:item_key, :expires_at);'
        );
        $statement->bindValue('item_key', $key);
        $statement->bindValue('expires_at', date('Y-m-d H:i:s',$expiresAt));
        $statement->execute();
        $connection->close();
    }

    /**
     * @inheritdoc
     */
    public function remove($key)
    {
        $connection = $this->_em->getConnection();
        $statement  = $connection->prepare('DELETE FROM nv_request_limit_items WHERE item_key = :item_key');
        $statement->bindValue('item_key', $key);
        $statement->execute();
        $connection->close();
    }

    /**
     * @return array
     */
    public function fetchAllItems()
    {
        $connection = $this->_em->getConnection();
        $statement  = $connection->prepare('SELECT * FROM nv_request_limit_items');
        $statement->execute();
        $result     = $statement->fetchAll();
        $connection->close();

        return $result;
    }

    /**
     * @return int
     */
    public function getItemsCount()
    {
        $connection = $this->_em->getConnection();
        $statement  = $connection->prepare('SELECT COUNT(*) FROM nv_request_limit_items');
        $statement->execute();
        $result     = $statement->fetchColumn(0);
        $connection->close();

        return $result;
    }
}
