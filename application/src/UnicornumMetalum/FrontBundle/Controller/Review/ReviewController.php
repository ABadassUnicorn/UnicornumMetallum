<?php

namespace UnicornumMetalum\FrontBundle\Controller\Review;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ReviewController extends Controller
{
    /**
    * @Route("/reviews", name="unicornum_metalum_reviews")
    */
    public function reviewsAction(Request $request)
    {
        return $this->render('UnicornumMetalumFrontBundle:Reviews:reviews.html.twig');
    }
    
    /**
    * @Route("/write-review", name="unicornum_metalum_write_review")
    */
    public function writeReviewAction(Request $request)
    {
        return $this->render('UnicornumMetalumFrontBundle:Reviews:write.html.twig');
    }
    
    /**
    * @Route("/read-review/{reviewId}", name="unicornum_metalum_read_review")
    */
    public function readReviewAction(Request $request, $reviewId)
    {
        return $this->render('UnicornumMetalumFrontBundle:Reviews:read.html.twig');
    }
}