<?php

namespace Bloghoven\Bundle\BlogBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
* 
*/
class HomeController extends Controller
{
  public function homeAction(Request $request)
  {
    $pagerfanta = $this->get('bloghoven.content_provider')->getHomeEntriesPager();

    $pagerfanta->setMaxPerPage($this->get('bloghoven.settings')->get('per_page'));
    $pagerfanta->setCurrentPage($request->query->get('page', 1));

    return $this->render('BloghovenAbstractThemeBundle:Home:home.html.twig', array('pager' => $pagerfanta));
  }
}