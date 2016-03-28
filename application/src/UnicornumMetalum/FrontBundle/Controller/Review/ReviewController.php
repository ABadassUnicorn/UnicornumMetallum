<?php

namespace UnicornumMetalum\FrontBundle\Controller\Review;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ReviewController extends Controller
{
    /**
    * @Route("/reviews", name="unicornum_metalum_reviews")
    */
    public function reviewsAction()
    {
        return $this->render('UnicornumMetalumFrontBundle:Reviews:reviews.html.twig');
    }
}
