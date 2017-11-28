<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [];
        if (in_array($this->getEnvironment(), ['test'])) {
            $bundles[] = new Symfony\Bundle\FrameworkBundle\FrameworkBundle();
            $bundles[] = new NV\RequestLimitBundle\NVRequestLimitBundle();
        }
        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config.yml');
    }
}
