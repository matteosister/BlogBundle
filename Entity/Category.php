<?php
/* 
 *  Matteo Giachino <m.giachino@vivacom.com>
 *  Vivacom 2011
 *  Just for fun...
 */

namespace Cypress\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Cypress\BlogBundle\Entity\Post;

/**
 * @ORM\Entity
 * @ORM\Table(name="blog_categories")
 */
class Category {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(unique="true")
     */
    private $name;

    /**
     * @ORM\Column
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="category")
     */
    private $posts;
    
    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add posts
     */
    public function addPosts(Post $posts)
    {
        $this->posts[] = $posts;
    }

    /**
     * Get posts
     *
     * @return Doctrine\Common\Collections\Collection $posts
     */
    public function getPosts()
    {
        return $this->posts;
    }
    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }
}