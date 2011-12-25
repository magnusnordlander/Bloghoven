<?php

namespace Bloghoven\Bundle\BlosxomDirProviderBundle\Entity;

use Bloghoven\Bundle\BlogBundle\ContentProvider\Interfaces\ImmutableEntryInterface;

/**
* 
*/
class Entry extends FileBasedEntity implements ImmutableEntryInterface
{
  // Getting the permalink id is kind of expensive, so
  // we'll cache it.
  protected $permalink_id;

  // These two are extra expensive to get, so whenever we get
  // one of them, we'll make sure to preload the other.
  protected $title;
  protected $contents;

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
    return \DateTime::createFromFormat('U', $this->file_info->getMTime());
  }

  public function isDraft()
  {
    return false;
  }

  public function getCategories()
  {
    $parent = $this->getParent();

    if (!$parent)
    {
      return null;
    }
    return array($parent);
  }
}