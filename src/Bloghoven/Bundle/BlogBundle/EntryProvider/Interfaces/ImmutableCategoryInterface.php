<?php

namespace Bloghoven\Bundle\BlogBundle\EntryProvider\Interfaces;

interface ImmutableCategoryInterface
{
  public function getName();

  public function getPermalinkId();

  public function getEntriesPager();
}