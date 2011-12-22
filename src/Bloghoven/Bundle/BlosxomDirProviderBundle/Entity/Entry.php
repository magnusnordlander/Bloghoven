<?php

namespace Bloghoven\Bundle\BlosxomDirProviderBundle\Entity;

use Bloghoven\Bundle\BlogBundle\EntryProvider\Interfaces\ImmutableEntryInterface;

/**
* 
*/
class Entry implements ImmutableEntryInterface
{
  protected $file_info;
  protected $data_dir;

  protected $category_factory;

  // Getting the permalink id is kind of expensive, so
  // we'll cache it.
  protected $permalink_id;

  // These two are extra expensive to get, so whenever we get
  // one of them, we'll make sure to preload the other.
  protected $title;
  protected $contents;

  public function setFileInfo(\SplFileInfo $file_info)
  {
    $this->file_info = $file_info;
  }

  public function setDataDir($data_dir)
  {
    $this->data_dir = $data_dir;
  }

  public function setCategoryFactory(CategoryFactory $cf)
  {
    $this->category_factory = $cf;
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

  protected function getFileExtension()
  {
    return $this->file_info->getExtension();
  }

  public function getPermalinkId()
  {
    if ($this->permalink_id === null)
    {
      $relative_path = $this->getRelativePath();
  
      $base_name = $this->file_info->getBaseName('.'.$this->getFileExtension());
  
      $this->permalink_id = "";
  
      if ($relative_path != "")
      {
        $this->permalink_id .= $relative_path.'/';
      }
      $this->permalink_id .= $base_name;
    }

    return $this->permalink_id;
  }

  public function getTitle()
  {
    if ($this->title === null)
    {
      $this->loadTitleAndContent();
    }

    return $this->title;
  }

  public function getExcerpt()
  {
    return $this->getContent();
  }

  public function getContent()
  {
    if ($this->content === null)
    {
      $this->loadTitleAndContent();
    }

    return $this->content;
  }

  protected function loadTitleAndContent()
  {
    $opened_file = $this->file_info->openFile();

    $this->title = trim($opened_file->current());
    $this->content = "";
    $opened_file->next();

    while (!$opened_file->eof())
    {
      $this->content .= $opened_file->current();
      $opened_file->next();
    }
  }

  public function getPostedAt()
  {
    return \DateTime::createFromFormat('U', $this->file_info->getMTime());
  }

  public function getModifiedAt()
  {
    return \DateTime::createFromFormat('U', $this->file->getMTime());
  }

  public function isDraft()
  {
    return false;
  }

  public function getCategories()
  {
    return $this->category_factory->getCategoriesFromPathFragment($this->getRelativePath());
  }
}