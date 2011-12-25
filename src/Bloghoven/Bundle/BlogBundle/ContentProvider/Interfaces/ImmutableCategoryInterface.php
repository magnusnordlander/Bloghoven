<?php

namespace Bloghoven\Bundle\BlogBundle\ContentProvider\Interfaces;

interface ImmutableCategoryInterface
{
  public function getName();

  public function getPermalinkId();

  public function getParent();

  public function getChildren();
}