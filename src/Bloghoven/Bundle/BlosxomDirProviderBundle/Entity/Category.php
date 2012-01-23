<?php

namespace Bloghoven\Bundle\BlosxomDirProviderBundle\Entity;

use Bloghoven\Bundle\BlogBundle\ContentProvider\Interfaces\ImmutableCategoryInterface;

use Symfony\Component\Finder\Finder;

/**
* 
*/
class Category extends FileBasedEntity implements ImmutableCategoryInterface
{
  public function getName()
  {
    return $this->file_info->getBasename();
  }

  public function getPermalinkId()
  {
    return $this->getRelativePathname();
  }

  public function getParent()
  {
    return parent::getParent();
  }

  public function getChildren()
  {
    $finder = new Finder();
    
    $finder
      ->directories()
      ->in($this->file_info->getPathname())
      ->depth('== 0')
      ->sortByName();

    $categories = array();

    foreach ($finder as $dir) 
    {
      $categories[] = new Category($dir, $this->content_provider);
    }

    return $categories;
  }
}