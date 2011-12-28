<?php

namespace Bloghoven\Bundle\BlogBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class BloghovenBlogExtension extends Extension
{
  /**
   * {@inheritDoc}
   */
  public function load(array $configs, ContainerBuilder $container)
  {
    $configuration = new Configuration();
    $config = $this->processConfiguration($configuration, $configs);

    $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
    $loader->load('services.xml');

    $container->setParameter('bloghoven.content_provider.id', $config['provider']);

    $def = $container->getDefinition('bloghoven.settings');

    $def->addMethodCall('set', array('name', $config['name']));
    $def->addMethodCall('set', array('tagline', $config['tagline']));
    $def->addMethodCall('set', array('per_page', $config['per_page']));
  }
}
