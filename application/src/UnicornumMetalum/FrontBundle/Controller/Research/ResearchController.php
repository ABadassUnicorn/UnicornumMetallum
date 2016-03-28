<?php

namespace UnicornumMetalum\FrontBundle\Controller\Research;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ResearchController extends Controller
{
    /**
    * @Route("/research", name="unicornum_metalum_research")
    */
    public function reviewsAction(Request $request)
    {
        return $this->render('UnicornumMetalumFrontBundle:Research:research.html.twig');
    }
}
