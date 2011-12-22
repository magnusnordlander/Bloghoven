<?php

namespace Bloghoven\Bundle\BlosxomDirProviderBundle\EntryProvider;

use Bloghoven\Bundle\BlosxomDirProviderBundle\Entity\Entry;

use Bloghoven\Bundle\BlogBundle\EntryProvider\Interfaces\EntryProviderInterface;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;

use Symfony\Component\Finder\Finder;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BlosxomDirEntryProvider implements EntryProviderInterface, ContainerAwareInterface
{
  protected $datadir;
  protected $file_extension;
  protected $depth;

  // Only use this to get entity prototypes, otherwise $kittens--
  protected $container;

  public function __construct($datadir, $file_extension = 'txt', $depth = 0)
  {
    $this->datadir = $datadir;
    $this->file_extension = $file_extension;
    $this->depth = (int)$depth;
  }

  public function setContainer(ContainerInterface $container = null)
  {
    $this->container = $container;
  }

  public function getHomeEntriesPager()
  {
    $finder = new Finder();
    
    $finder
      ->files()
      ->name('*.'.$this->file_extension)
      ->in($this->datadir)
      ->sort(function($file1, $file2)
      {
        return $file2->getMTime() - $file1->getMTime();
      });

    if ($this->depth > 0)
    {
      $finder->depth('<= '.($this->depth-1));
    }
    
    $entries = array();

    foreach ($finder as $file) 
    {
      $entry = $this->container->get('bloghoven.blosxom_dir_provider.entry.prototype');
      $entry->setFileInfo($file);
      $entry->setDataDir($this->datadir);
      $entries[] = $entry;
    }

    return new Pagerfanta(new ArrayAdapter($entries));
  }

  public function getEntryWithPermalinkId($permalink_id)
  {
    if (strpos($permalink_id, '..') !== false)
    {
      throw new \RuntimeException("Permalinks with double dots are not allowed with the current provider, and are always advised against.");
    }

    $file = new \SplFileInfo($this->datadir.'/'.$permalink_id.'.'.$this->file_extension);

    if ($file->isFile())
    {
      $entry = $this->container->get('bloghoven.blosxom_dir_provider.entry.prototype');
      $entry->setFileInfo($file);
      $entry->setDataDir($this->datadir);
      return $entry;
    }
    return null;
  }
}