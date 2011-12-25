<?php

namespace Bloghoven\Bundle\BlogBundle\ContentProvider\Interfaces;

interface ContentProviderInterface
{
  /**
   * @return Pagerfanta<ImmutableEntryInterface>
   */
  public function getHomeEntriesPager();

  /**
   * @return Pagerfanta<ImmutableEntryInterface>
   */
  public function getEntriesPagerForCategory(ImmutableCategoryInterface $category);

  /**
   * @return ImmutableEntryInterface
   */
  public function getEntryWithPermalinkId($permalink_id);

  /**
   * @return \Traversable<ImmutableCategoryInterface>|array<ImmutableCategoryInterface>
   */
  public function getCategoryRoots();

  /**
   * @return ImmutableCategoryInterface
   */
  public function getCategoryWithPermalinkId($permalink_id);
}