<?php

namespace Bloghoven\Bundle\BlogBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
* 
*/
class CategoryController extends Controller
{
  public function treeAction()
  {
    $roots = $this->get('bloghoven.content_provider')->getCategoryRoots();

    return $this->render('BloghovenAbstractThemeBundle:Category:tree.html.twig', array('roots' => $roots));
  }

  public function entriesAction(Request $request, $permalink_id)
  {
    $category = $this->get('bloghoven.content_provider')->getCategoryWithPermalinkId($permalink_id);

    $pagerfanta = $this->get('bloghoven.content_provider')->getEntriesPagerForCategory($category);

    $pagerfanta->setMaxPerPage($this->get('bloghoven.settings')->get('per_page'));
    $pagerfanta->setCurrentPage($request->query->get('page', 1));

    return $this->render('BloghovenAbstractThemeBundle:Category:entries.html.twig', array('category' => $category, 'pager' => $pagerfanta));
  }
}