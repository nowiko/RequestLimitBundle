<?php

namespace NW\RequestLimitBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class StoragePass
 * @package NW\RequestLimitBundle\DependencyInjection\Compiler
 * @author Novikov Viktor
 */
class StoragePass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $providerType            = $container->getParameter('nw_request_limit.provider_type');
        $providerConfiguration   = $container->getParameter('nw_request_limit.provider_configuration');
        $providerTypeServiceName = sprintf('nw.request_limit.%s.provider', $providerType);

        $providerDefinition = $container->getDefinition($providerTypeServiceName);
        $providerDefinition->addMethodCall('configure', [$providerConfiguration]);

        $storageManagerDefinition = $container->getDefinition('nw.request_limit.storage_manager');
        $storageManagerDefinition->addMethodCall('setProvider', [$providerDefinition]);
    }
}
