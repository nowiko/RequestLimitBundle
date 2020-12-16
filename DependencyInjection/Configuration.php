<?php

namespace NW\RequestLimitBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package NW\RequestLimitBundle\DependencyInjection
 * @author Novikov Viktor
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('request_limit');
        $rootNode
            ->children()
                ->integerNode('restriction_time')->end()
                ->scalarNode('provider_type')->end()
                ->arrayNode('provider_configuration')
                    ->prototype('scalar')
                    ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
