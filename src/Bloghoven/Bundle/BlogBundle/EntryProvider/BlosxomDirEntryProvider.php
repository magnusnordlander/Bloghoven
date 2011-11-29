<?php

namespace Bloghoven\Bundle\BlogBundle\EntryProvider;

use Bloghoven\Bundle\BlogBundle\Interfaces\EntryProviderInterface;

use Bloghoven\Bundle\BlogBundle\Entity\Entry;

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
        return $file2->getCTime() - $file1->getCTime();
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

  protected function hydrateEntryFromFile(\SplFileInfo $file)
  {
    $entry = new Entry;

    $entry->setPostedAt(\DateTime::createFromFormat('U', $file->getCTime()));
    $entry->setModifiedAt(\DateTime::createFromFormat('U', $file->getMTime()));

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