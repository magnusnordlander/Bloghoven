<?php

namespace Bloghoven\Bundle\BlosxomDirProviderBundle\EntryProvider;

use Bloghoven\Bundle\BlogBundle\Entity\Entry;

use Bloghoven\Bundle\BlogBundle\EntryProvider\Interfaces\EntryProviderInterface;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;

use Symfony\Component\Finder\Finder;

class BlosxomDirEntryProvider implements EntryProviderInterface
{
  protected $datadir;
  protected $file_extension;
  protected $depth;

  public function __construct($datadir, $file_extension = 'txt', $depth = 0)
  {
    $this->datadir = $datadir;
    $this->file_extension = $file_extension;
    $this->depth = (int)$depth;
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
      $entries[] = $this->hydrateEntryFromFile($file);
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
      return $this->hydrateEntryFromFile($file);
    }
    return null;
  }

  protected function hydrateEntryFromFile(\SplFileInfo $file)
  {
    $entry = new Entry;

    $entry->setPostedAt(\DateTime::createFromFormat('U', $file->getMTime()));
    $entry->setModifiedAt(\DateTime::createFromFormat('U', $file->getMTime()));

    $full_path = $file->getPath();

    if (substr($full_path, 0, strlen($this->datadir)) == $this->datadir)
    {
      $relative_path = trim(substr($full_path, strlen($this->datadir)), '/');
    }
    else
    {
      throw new \RuntimeException("Path of entry is not as expected");
    }

    $base_name = $file->getBaseName('.'.$this->file_extension);

    $id = "";

    if ($relative_path != "")
    {
      $id .= $relative_path.'/';
    }
    $id .= $base_name;
    $entry->setId($id);

    $opened_file = $file->openFile();

    $title = $opened_file->current();
    $content = "";
    $opened_file->next();

    while (!$opened_file->eof())
    {
      $content .= $opened_file->current();
      $opened_file->next();
    }

    $entry->setTitle(trim($title));
    $entry->setContent($content);

    return $entry;
  }
}