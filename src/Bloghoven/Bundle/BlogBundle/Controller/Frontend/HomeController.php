<?php

namespace Bloghoven\Bundle\BlogBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
* 
*/
class HomeController extends Controller
{
  public function homeAction($page = 1)
  {
    $pagerfanta = $this->get('bloghoven.entry_provider')->getHomeEntriesPager();

    $pagerfanta->setMaxPerPage(10);
    $pagerfanta->setCurrentPage($page);

    return $this->render('BloghovenAbstractThemeBundle:Home:home.html.twig', array('pager' => $pagerfanta));
  }
}