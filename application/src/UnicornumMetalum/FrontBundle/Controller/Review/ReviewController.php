<?php

namespace UnicornumMetalum\FrontBundle\Controller\Review;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use UnicornumMetalum\FrontBundle\Form\ReviewType;
use UnicornumMetalum\EntityBundle\Entity\Review;
use UnicornumMetalum\EntityBundle\Entity\Tag;

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
        $em = $this->getDoctrine()->getEntityManager();
        $review = new Review();
        $form = $this->createForm(new ReviewType(), $review);
        $form->handleRequest($request);
        if($form->get('save')->isClicked()){
            
        }
        return $this->render('UnicornumMetalumFrontBundle:Reviews:write.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    /**
    * @Route("/read-review/{reviewId}", name="unicornum_metalum_read_review")
    */
    public function readReviewAction(Request $request, $reviewId)
    {
        return $this->render('UnicornumMetalumFrontBundle:Reviews:read.html.twig');
    }
}