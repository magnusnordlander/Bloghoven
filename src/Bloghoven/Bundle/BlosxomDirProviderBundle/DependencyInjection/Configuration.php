<?php

namespace Bloghoven\Bundle\BlosxomDirProviderBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('bloghoven_blosxom_dir_provider');

        $rootNode
            ->children()
                ->scalarNode('data_dir')->defaultValue('%kernel.root_dir%/data')->end()
                ->scalarNode('file_extension')->defaultValue('txt')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
