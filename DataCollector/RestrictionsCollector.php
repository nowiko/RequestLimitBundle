<?php

namespace NV\RequestLimitBundle\DataCollector;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;

class RestrictionsCollector implements DataCollectorInterface
{
    /**
     * @inheritdoc
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $this->data = [
            'countRestrictions' => 0,
            'restrictions'      => []
        ];
    }

    public function getName()
    {
        return 'nv.request_limit.restrictions_collector';
    }
}
