<?php

namespace Bloghoven\Bundle\BlogBundle\EntryProvider;

use Bloghoven\Bundle\BlogBundle\Interfaces\EntryProviderInterface;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

use Doctrine\ORM\EntityRepository;

class DoctrineORMEntryProvider implements EntryProviderInterface
{
  protected $repo;

  public function __construct(EntityRepository $repo)
  {
    $this->repo = $repo;
  }

  public function getHomeEntriesPager()
  {
    $qb = $this->repo->createQueryBuilder('e');

    return new Pagerfanta(new DoctrineORMAdapter($qb));
  }
}