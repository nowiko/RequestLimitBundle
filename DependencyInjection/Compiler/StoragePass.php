<?php

namespace NV\RequestLimitBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class StoragePass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $providerType            = $container->getParameter('nv_request_limit.provider_type');
        $providerConfiguration   = $container->getParameter('nv_request_limit.provider_configuration');
        $providerTypeServiceName = sprintf('nv.request_limit.%s.provider', $providerType);

        $providerDefinition = $container->getDefinition($providerTypeServiceName);
        $providerDefinition->addMethodCall('configure', [$providerConfiguration]);

        $storageManagerDefinition = $container->getDefinition('nv.request_limit.storage_manager');
    }

}
