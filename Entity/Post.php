<?php
/* 
 *  Matteo Giachino <m.giachino@vivacom.com>
 *  Vivacom 2011
 *  Just for fun...
 */

namespace Cypress\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Cypress\BlogBundle\Entity\Category;
use Cypress\BlogBundle\Entity\Comment;

/**
 * @ORM\Entity
 * @ORM\Table(name="blog_posts")
 * @ORM\HasLifecycleCallbacks
 */
class Post {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(unique="true")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length="1000", name="testo_abstract")
     */
    private $abstract;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="text", name="the_text")
     */
    private $theText;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="posts", cascade={"all"})
     * @ORM\JoinColumn(onDelete="cascade", onUpdate="cascade")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="posts", cascade={"all"})
     * @ORM\JoinTable(name="blog_post_tag")
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post", cascade={"all"})
     */
    private $comments;

    /**
     * @ORM\Column(type="string", unique="true")
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime", nullable="true")
     */
    private $created_at;
    
    /**
     * @ORM\Column(type="datetime", nullable="true")
     */
    private $updated_at;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->created_at = $this->updated_at = new \DateTime('now');
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * @ORM\PrePersist
     */
    public function updateTimestampable()
    {
        $this->updated_at = new \DateTime('now');
    }

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set theText
     *
     * @param text $theText
     */
    public function setTheText($theText)
    {
        $this->theText = $theText;
    }

    /**
     * Get theText
     *
     * @return text $theText
     */
    public function getTheText()
    {
        return $this->theText;
    }

    /**
     * Set date
     *
     * @param datetime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return datetime $date
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime $createdAt
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    }

    /**
     * Get updated_at
     *
     * @return datetime $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
    /**
     * Set abstract
     *
     * @param string $abstract
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;
    }

    /**
     * Get abstract
     *
     * @return string $abstract
     */
    public function getAbstract()
    {
        return $this->abstract;
    }
    /**
     * Set slug
     *
     * @param text $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return text $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }
    
    /**
     * Set category
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get category
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * Add tags
     */
    public function addTags(Tag $tags)
    {
        $this->tags[] = $tags;
    }

    /**
     * Get tags
     *
     * @return Doctrine\Common\Collections\Collection $tags
     */
    public function getTags()
    {
        return $this->tags;
    }
    /**
     * Add comments
     */
    public function addComments(Comment $comments)
    {
        if ($comments->getPost() == null) {
            $comments->setPost($this);
        }
        $this->comments[] = $comments;
    }

    /**
     * Get comments
     */
    public function getComments()
    {
        return $this->comments;
    }
}