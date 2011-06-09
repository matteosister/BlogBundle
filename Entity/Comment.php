<?php
/* 
 *  Matteo Giachino <m.giachino@vivacom.com>
 *  Vivacom 2011
 *  Just for fun...
 */


namespace Cypress\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="blog_comments")
 */
class Comment {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(length="50")
     */
    private $user;

    /**
     * @ORM\Column(type="text", name="the_text")
     */
    private $theText;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
     * @ORM\JoinColumn(onDelete="cascade", onUpdate="cascade")
     */
    private $post;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="Comment", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="cascade", onUpdate="cascade")
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
     * @param Cypress\BlogBundle\Entity\Comment $children
     */
    public function addChildren(\Cypress\BlogBundle\Entity\Comment $children)
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
     * @param Cypress\BlogBundle\Entity\Post $post
     */
    public function setPost(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get post
     *
     * @return Cypress\BlogBundle\Entity\Post $post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set parent
     *
     * @param Cypress\BlogBundle\Entity\Comment $parent
     */
    public function setParent(Comment $parent)
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return Cypress\BlogBundle\Entity\Comment $parent
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