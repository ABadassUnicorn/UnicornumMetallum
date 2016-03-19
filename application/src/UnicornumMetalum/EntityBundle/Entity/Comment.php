<?php

namespace UnicornumMetalum\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="UnicornumMetalum\EntityBundle\Entity\CommentRepository")
 */
class Comment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;
        
    /**
     * @ORM\ManyToOne(targetEntity="Review")
     * @ORM\JoinColumn(name="review_id", referencedColumnName="id")
     */
    private $review;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set author
     *
     * @param \Application\Sonata\UserBundle\Entity\User $author
     * @return Comment
     */
    public function setAuthor(\Application\Sonata\UserBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Application\Sonata\UserBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set review
     *
     * @param \UnicornumMetalum\EntityBundle\Entity\Review $review
     * @return Comment
     */
    public function setReview(\UnicornumMetalum\EntityBundle\Entity\Review $review = null)
    {
        $this->review = $review;

        return $this;
    }

    /**
     * Get review
     *
     * @return \UnicornumMetalum\EntityBundle\Entity\Review 
     */
    public function getReview()
    {
        return $this->review;
    }
}
