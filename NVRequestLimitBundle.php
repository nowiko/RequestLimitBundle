<?php

namespace NV\RequestLimitBundle;

use NV\RequestLimitBundle\DependencyInjection\Compiler\StoragePass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class NVRequestLimitBundle
 * @package NV\RequestLimitBundle
 * @author Novikov Viktor
 */
class NVRequestLimitBundle extends Bundle
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
