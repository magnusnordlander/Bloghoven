<?php

namespace Bloghoven\Bundle\BlosxomDirProviderBundle\Entity;

use Bloghoven\Bundle\BlogBundle\EntryProvider\Interfaces\ImmutableCategoryInterface;

/**
* 
*/
class Category implements ImmutableCategoryInterface
{
  protected $path_fragment;

  public function __construct($path_fragment)
  {
    $this->path_fragment = $path_fragment;
  }

  public function getName()
  {
    $explosion = explode('/', $this->path_fragment);
    return end($explosion);
  }

  public function getPermalinkId()
  {
    return $this->path_fragment;
  }

  public function getEntriesPager()
  {
    
  }
}