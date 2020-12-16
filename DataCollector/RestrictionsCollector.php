<?php

namespace NW\RequestLimitBundle\DataCollector;

use NW\RequestLimitBundle\Storage\StorageManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;

/**
 * Class RestrictionsCollector
 * @package NW\RequestLimitBundle\DataCollector
 * @author Novikov Viktor
 */
class RestrictionsCollector implements DataCollectorInterface
{
    /**
     * @var array
     */
    private $data;

    /** @var StorageManager $storageManager */
    private $storageManager;

    /**
     * {@inheritdoc}
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $this->data = [
            'restrictionsCount' => $this->storageManager->getItemsCount(),
            'restrictions'      => $this->storageManager->fetchAllItems()
        ];
    }

    /**
     * @return array
     */
    public function getRestrictionsCount()
    {
        return $this->data['restrictionsCount'];
    }

    /**
     * @return array
     */
    public function getRestrictions()
    {
        return $this->data['restrictions'];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'nw.request_limit.restrictions_collector';
    }

    /**
     * @param StorageManager $manager
     */
    public function setStorageManager(StorageManager $manager)
    {
        $this->storageManager = $manager;
    }

    /**
     * @return array
     */
    public function __sleep()
    {
        return ['data'];
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->data = [];
    }
}
