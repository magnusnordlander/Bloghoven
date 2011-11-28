<?php

namespace Bloghoven\Bundle\BlogBundle\Interfaces;

interface EntryProviderInterface
{
  public function getHomeEntriesPager();
}