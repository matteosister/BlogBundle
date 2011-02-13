<?php

namespace Bundle\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class BlogController extends Controller
{
    private $em;

    /**
     * Retrieve the EntityManager instance
     * @return \Doctrine\ORM\EntityManager
     */
    private function getEm()
    {
        if (null == $this->em) {
            $this->em = $this->get('doctrine.orm.entity_manager');
        }
        return $this->em;
    }

    /**
     * @route: blog_home
     * Homepage controller
     */
    public function homeAction()
    {
        // entity manager
        $em = $this->getEm();
        
        $qb = new QueryBuilder($em);
        // dql query
        $qb->select('p,c,t')
            ->from('Bundle\BlogBundle\Entity\Post', 'p')
            ->join('p.category', 'c')
            ->join('p.tags', 't')
            ->orderBy('p.date', 'DESC');
        // array of objects
        $posts = $qb->getQuery()->getResult();

        $query = $em->createQuery('SELECT c,p FROM Bundle\BlogBundle\Entity\Category c JOIN c.posts p');
        $categories = $query->getResult();

        $query = $em->createQuery('SELECT t,p FROM Bundle\BlogBundle\Entity\Tag t JOIN t.posts p');
        $tags = $query->getResult();

        return $this->render('BlogBundle:Blog:homepage.html.twig', array(
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags
        ));
    }

    /**
     * @route: blog_post
     * @param string $slug
     * Single post Controller
     */
    public function postAction($slug)
    {
        // entity manager and query builder objects
        $em = $this->getEm();
        

        $query = new Query($em);
        $query->setDQL(
            'SELECT p,comments 
                FROM Bundle\BlogBundle\Entity\Post p
                JOIN p.comments comments
                WHERE p.slug = ?1'
        );
        $query->setParameter(1, $slug);
        $posts = $query->getResult();


        return $this->render('BlogBundle:Blog:post.html.twig', array(
            'post' => $posts[0]
        ));
    }

    /**
     * @route: blog_categories
     * Categories Controller
     */
    public function categoriesAction()
    {
        $em = $this->getEm();
        $query = new Query($em);
        $query->setDQL(
            'SELECT c
                FROM Bundle\BlogBundle\Entity\Category c'
        );
        $categories = $query->getResult();

        return $this->render('BlogBundle:Blog:categories.html.twig', array(
            'categories' => $categories
        ));
    }


    public function categoryAction($slug)
    {
        $em = $this->getEm();
        $query = new Query($em);
        $query->setDQL(
            'SELECT c
                FROM Bundle\BlogBundle\Entity\Category c WHERE c.slug = ?1'
        );
        $query->setParameter(1, $slug);
        $category = $query->getSingleResult();

        return $this->render('BlogBundle:Blog:category.html.twig', array(
            'category' => $category,
            'posts'    => $category->getPosts()
        ));
    }

    /**
     * @route: blog_tags
     * Tags Controller
     */
    public function tagsAction()
    {
        $em = $this->getEm();
        $query = new Query($em);
        $query->setDQL(
            'SELECT t
                FROM Bundle\BlogBundle\Entity\Tag t'
        );
        $tags = $query->getResult();

        return $this->render('BlogBundle:Blog:tags.html.twig', array(
            'tags' => $tags
        ));
    }


    /**
     * @route: blog_tag
     * Tag Controller
     */
    public function tagAction($slug)
    {
        $em = $this->getEm();
        $query = new Query($em);
        $query->setDQL(
            'SELECT t
                FROM Bundle\BlogBundle\Entity\Tag t WHERE t.slug = ?1'
        );
        $query->setParameter(1, $slug);
        $tag = $query->getSingleResult();

        

        return $this->render('BlogBundle:Blog:tag.html.twig', array(
            'tag' => $tag,
            'posts' => $tag->getPosts()
        ));
    }
}
