<?php

namespace Bloghoven\Bundle\BlogBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
* 
*/
class EntryController extends Controller
{
  public function permalinkAction($permalink_id)
  {
    $entry = $this->get('bloghoven.content_provider')->getEntryWithPermalinkId($permalink_id);

    if (!$entry)
    {
      throw new NotFoundHttpException();
    }

    return $this->render('BloghovenAbstractThemeBundle:Permalink:permalink.html.twig', array('entry' => $entry));
  }
}