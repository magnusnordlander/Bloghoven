<?php

namespace Bloghoven\Bundle\BlogBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('bloghoven_blog');

        $rootNode
            ->children()
                ->scalarNode('provider')->defaultValue('doctrine.orm')->end()
                ->scalarNode('per_page')->defaultValue(10)->end()
                ->scalarNode('name')->defaultValue('Your blog')->end()
                ->scalarNode('tagline')->defaultValue('Just another Bloghoven blog')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
