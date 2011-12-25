<?php

namespace Bloghoven\Bundle\BlogBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class TaggedProviderPass implements CompilerPassInterface
{
  /**
   * @see Symfony\Component\DependencyInjection\Compiler.CompilerPassInterface::process()
   */
  public function process(ContainerBuilder $container)
  {
    if (!$container->hasParameter('bloghoven.content_provider.id')) {
      return;
    }
    
    $tags = $container->findTaggedServiceIds('bloghoven.content_provider');

    foreach ($tags as $service_id => $tag) 
    {
      if ($tag[0]['id'] == $container->getParameter('bloghoven.content_provider.id'))
      {
        $container->setAlias('bloghoven.content_provider', $service_id);

        return;
      }
    }
  }
}