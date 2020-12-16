<?php

namespace NW\RequestLimitBundle;

use NW\RequestLimitBundle\DependencyInjection\Compiler\StoragePass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class NWRequestLimitBundle
 * @package NW\RequestLimitBundle
 * @author Novikov Viktor
 */
class NWRequestLimitBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new StoragePass());
    }
}
