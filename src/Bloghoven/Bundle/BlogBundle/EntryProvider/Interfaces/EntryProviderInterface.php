<?php

namespace Bloghoven\Bundle\BlogBundle\EntryProvider\Interfaces;

interface EntryProviderInterface
{
  public function getHomeEntriesPager();

  public function getEntryWithPermalinkId($permalink_id);
}