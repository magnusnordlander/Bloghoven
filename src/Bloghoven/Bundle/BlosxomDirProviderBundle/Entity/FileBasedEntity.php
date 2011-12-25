<?php

namespace Bloghoven\Bundle\BlosxomDirProviderBundle\Entity;

/**
* 
*/
abstract class FileBasedEntity
{
  protected $file_info;
  protected $data_dir;
  protected $data_dir_info;

  public function __construct(\SplFileInfo $file_info, $data_dir)
  {
    $this->file_info = $file_info;
    $this->data_dir = $data_dir;
    $this->data_dir_info = new \SplFileInfo($data_dir);
  }

  public function getAbsolutePath()
  {
    return $this->file_info->getPathname();
  }

  protected function getRelativePath()
  {
    $full_path = $this->file_info->getPath();

    if (substr($full_path, 0, strlen($this->data_dir)) == $this->data_dir)
    {
      return trim(substr($full_path, strlen($this->data_dir)), '/');
    }
    else
    {
      throw new \RuntimeException("Path of entry is not as expected");
    }
  }

  protected function getRelativePathname()
  {
    $full_path = $this->file_info->getPathname();

    if (substr($full_path, 0, strlen($this->data_dir)) == $this->data_dir)
    {
      return trim(substr($full_path, strlen($this->data_dir)), '/');
    }
    else
    {
      throw new \RuntimeException("Path of entry is not as expected");
    }
  }

  protected function getParent()
  {
    if ($this->file_info->getPathInfo()->getRealPath() != $this->data_dir_info->getRealPath())
    {
      return new Category($this->file_info->getPathInfo(), $this->data_dir);      
    }
    return null;
  }

}