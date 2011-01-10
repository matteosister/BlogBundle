<?php
/* 
 *  Matteo Giachino <m.giachino@vivacom.com>
 *  Vivacom 2011
 *  Just for fun...
 */


namespace Application\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @orm:Entity
 * @orm:Table(name="blog_comments")
 */
class Comment {

    /**
     * @orm:Column(type="integer")
     * @orm:Id
     * @orm:GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @orm:Column(length="50")
     */
    private $user;

    /**
     * @orm:Column(type="text", name="the_text")
     */
    private $theText;

    /**
     * @orm:Column(type="datetime")
     */
    private $date;

    /**
     * @orm:ManyToOne(targetEntity="post", inversedBy="comments")
     */
    private $post;

    /**
     * @orm:OneToMany(targetEntity="Comment", mappedBy="parent")
     */
    private $children;

    /**
     * @orm:ManyToOne(targetEntity="Comment", inversedBy="children")
     * @JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }
    /**
     * Get id
     *
     * @return string $id
     */
    public function getId()
    {
        return $this->id;
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
     * Add children
     *
     * @param Application\BlogBundle\Entity\Comment $children
     */
    public function addChildren(\Application\BlogBundle\Entity\Comment $children)
    {
        $this->children[] = $children;
    }

    /**
     * Get children
     *
     * @return Doctrine\Common\Collections\Collection $children
     */
    public function getChildren()
    {
        return $this->children;
    }
    /**
     * Set post
     *
     * @param Application\BlogBundle\Entity\post $post
     */
    public function setPost(\Application\BlogBundle\Entity\post $post)
    {
        $this->post = $post;
    }

    /**
     * Get post
     *
     * @return Application\BlogBundle\Entity\post $post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set parent
     *
     * @param Application\BlogBundle\Entity\Comment $parent
     */
    public function setParent(\Application\BlogBundle\Entity\Comment $parent)
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return Application\BlogBundle\Entity\Comment $parent
     */
    public function getParent()
    {
        return $this->parent;
    }
    /**
     * Set user
     *
     * @param string $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return string $user
     */
    public function getUser()
    {
        return $this->user;
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
}