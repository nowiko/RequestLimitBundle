<?php

namespace NV\RequestLimitBundle\DataCollector;

use NV\RequestLimitBundle\Storage\StorageManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;

class RestrictionsCollector implements DataCollectorInterface
{
    /**
     * @var array
     */
    private $data;

    /** @var StorageManager $storageManager */
    private $storageManager;

    /**
     * @inheritdoc
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
        return 'nv.request_limit.restrictions_collector';
    }

    /**
     * @param StorageManager $manager
     */
    public function setStorageManager(StorageManager $manager)
    {
        $this->storageManager = $manager;
    }
}
