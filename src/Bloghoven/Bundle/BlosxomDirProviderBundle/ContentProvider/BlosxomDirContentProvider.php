<?php

namespace Bloghoven\Bundle\BlosxomDirProviderBundle\ContentProvider;

use Bloghoven\Bundle\BlosxomDirProviderBundle\Entity\Entry;
use Bloghoven\Bundle\BlosxomDirProviderBundle\Entity\Category;

use Bloghoven\Bundle\BlogBundle\ContentProvider\Interfaces\ContentProviderInterface;
use Bloghoven\Bundle\BlogBundle\ContentProvider\Interfaces\ImmutableCategoryInterface;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;

use Symfony\Component\Finder\Finder;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BlosxomDirContentProvider implements ContentProviderInterface, ContainerAwareInterface
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
      $entries[] = new Entry($file, $this->datadir);
    }

    return new Pagerfanta(new ArrayAdapter($entries));
  }

  public function getEntriesPagerForCategory(ImmutableCategoryInterface $category)
  {
    if (!($category instanceof Category))
    {
      throw new \LogicException("The Blosxom dir provider only supports categories from the same provider.");
    }

    $finder = new Finder();
    
    $finder
      ->files()
      ->name('*.'.$this->file_extension)
      ->in($category->getAbsolutePath())
      ->sort(function($file1, $file2)
      {
        return $file2->getMTime() - $file1->getMTime();
      });

    // Depth should perhaps be configurable?
    
    $entries = array();

    foreach ($finder as $file) 
    {
      $entries[] = new Entry($file, $this->datadir);
    }

    return new Pagerfanta(new ArrayAdapter($entries));
  }

  public function getCategoryRoots()
  {
    $finder = new Finder();
    
    $finder
      ->directories()
      ->in($this->datadir)
      ->depth('== 0')
      ->sortByName();

    $categories = array();

    foreach ($finder as $dir) 
    {
      $categories[] = new Category($dir, $this->datadir);
    }

    return $categories;
  }

  protected function validatePermalinkId($permalink_id)
  {
    if (strpos($permalink_id, '..') !== false)
    {
      throw new \RuntimeException("Permalinks with double dots are not allowed with the current provider, and are always advised against.");
    }
  }

  public function getEntryWithPermalinkId($permalink_id)
  {
    $this->validatePermalinkId($permalink_id);

    $file = new \SplFileInfo($this->datadir.'/'.$permalink_id.'.'.$this->file_extension);

    if ($file->isFile())
    {
      return new Entry($file, $this->datadir);
    }
    return null;
  }

  public function getCategoryWithPermalinkId($permalink_id)
  {
    $this->validatePermalinkId($permalink_id);

    $dir = new \SplFileInfo($this->datadir.'/'.$permalink_id);

    if ($dir->isDir())
    {
      return new Category($dir, $this->datadir);
    }
    return null;
  }
}