<?php

namespace Bloghoven\Bundle\BlosxomDirProviderBundle\Entity;

/**
* 
*/
class CategoryFactory
{
  public function getCategoriesFromPathFragment($path_fragment)
  {
    $path_fragment = trim($path_fragment, '/');

    return array(new Category($path_fragment));
  }
}