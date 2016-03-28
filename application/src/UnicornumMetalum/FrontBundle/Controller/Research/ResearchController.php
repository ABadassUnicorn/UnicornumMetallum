<?php

namespace UnicornumMetalum\FrontBundle\Controller\Research;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ResearchController extends Controller
{
    /**
    * @Route("/research", name="unicornum_metalum_research")
    */
    public function reviewsAction()
    {
        return $this->render('UnicornumMetalumFrontBundle:Research:research.html.twig');
    }
}
