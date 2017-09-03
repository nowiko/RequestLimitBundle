<?php

namespace NV\RequestLimitBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @inheritdoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('request_limit');

        $rootNode
            ->children()
                ->scalarNode('provider_type')->end()
                ->arrayNode('provider_configuration')
                    ->prototype('scalar')
                    ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
