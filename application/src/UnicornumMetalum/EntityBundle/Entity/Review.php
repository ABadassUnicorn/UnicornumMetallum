<?php

namespace UnicornumMetalum\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Review
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="UnicornumMetalum\EntityBundle\Entity\ReviewRepository")
 */
class Review
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="review", type="text")
     */
    private $review;

    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="Tag")
     */
    private $tags;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;
    
    /**
    * @var date $birthday
    *
    * @ORM\Column(name="date", type="date", nullable=true)
    */
    private $date;

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
     * Set review
     *
     * @param string $review
     * @return Review
     */
    public function setReview($review)
    {
        $this->review = $review;

        return $this;
    }

    /**
     * Get review
     *
     * @return string 
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * Set category
     *
     * @param \UnicornumMetalum\EntityBundle\Entity\Category $category
     * @return Review
     */
    public function setCategory(\UnicornumMetalum\EntityBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \UnicornumMetalum\EntityBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setDate(new \DateTime('now'));
    }

    /**
     * Add tags
     *
     * @param \UnicornumMetalum\EntityBundle\Entity\Tag $tags
     * @return Review
     */
    public function addTag(\UnicornumMetalum\EntityBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \UnicornumMetalum\EntityBundle\Entity\Tag $tags
     */
    public function removeTag(\UnicornumMetalum\EntityBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set author
     *
     * @param \UnicornumMetalum\EntityBundle\Entity\User $author
     * @return Review
     */
    public function setAuthor(\Application\Sonata\UserBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \UnicornumMetalum\EntityBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Review
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Get name
     *
     * @return string 
     */
    public function __toString()
    {
        return $this->name . ' - ' . $this->getAuthor() . ' - ' . $this->getDate()->format('Y-m-d');
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Review
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }
}
