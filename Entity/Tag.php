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
 * @ORM\Table(name="blog_tags")
 */
class Tag {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(unique="true")
     */
    private $label;

    /**
     * @ORM\Column(unique="true")
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="tags")
     */
    private $posts;


    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getLabel();
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
     * Set label
     *
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * Get label
     *
     * @return string $label
     */
    public function getLabel()
    {
        return $this->label;
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
 
}