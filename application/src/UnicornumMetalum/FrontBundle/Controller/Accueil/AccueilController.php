<?php

namespace UnicornumMetalum\FrontBundle\Controller\Accueil;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AccueilController extends Controller
{
    /**
    * @Route("/accueil", name="unicornum_metalum_home")
    */
    public function accueilAction()
    {
        return $this->render('UnicornumMetalumFrontBundle:Accueil:accueil.html.twig');
    }
}
