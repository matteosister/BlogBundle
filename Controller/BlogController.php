<?php

namespace Cypress\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class BlogController extends Controller
{
    /**
     * Retrieve the EntityManager instance
     * @return \Doctrine\ORM\EntityManager
     */
    private function getEm()
    {
        return $this->get('doctrine.orm.entity_manager');
    }

    /**
     * Homepage controller
     */
    public function homeAction()
    {
        // entity manager
        $em = $this->getEm();
        
        $qb = new QueryBuilder($em);
        // dql query
        $qb->select('p,c,t')
            ->from('CypressBlogBundle:Post', 'p')
            ->join('p.category', 'c')
            ->join('p.tags', 't')
            ->orderBy('p.date', 'DESC');
        // array of objects
        $posts = $qb->getQuery()->getResult();

        $query = $em->createQuery('SELECT c,p FROM CypressBlogBundle:Category c JOIN c.posts p');
        $categories = $query->getResult();

        $query = $em->createQuery('SELECT t,p FROM CypressBlogBundle:Tag t JOIN t.posts p');
        $tags = $query->getResult();

        return $this->render('CypressBlogBundle:Blog:homepage.html.twig', array(
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags
        ));
    }

    /**
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
                FROM CypressBlogBundle:Post p
                JOIN p.comments comments
                WHERE p.slug = ?1'
        );
        $query->setParameter(1, $slug);
        $posts = $query->getResult();


        return $this->render('CypressBlogBundle:Blog:post.html.twig', array(
            'post' => $posts[0]
        ));
    }

    /**
     * Categories Controller
     */
    public function categoriesAction()
    {
        $em = $this->getEm();
        $query = new Query($em);
        $query->setDQL(
            'SELECT c
                FROM CypressBlogBundle:Category c'
        );
        $categories = $query->getResult();

        return $this->render('CypressBlogBundle:Blog:categories.html.twig', array(
            'categories' => $categories
        ));
    }


    public function categoryAction($slug)
    {
        $em = $this->getEm();
        $query = new Query($em);
        $query->setDQL(
            'SELECT c
                FROM CypressBlogBundle:Category c WHERE c.slug = ?1'
        );
        $query->setParameter(1, $slug);
        $category = $query->getSingleResult();

        return $this->render('CypressBlogBundle:Blog:category.html.twig', array(
            'category' => $category,
            'posts'    => $category->getPosts()
        ));
    }

    /**
     * Tags Controller
     */
    public function tagsAction()
    {
        $em = $this->getEm();
        $query = new Query($em);
        $query->setDQL(
            'SELECT t
                FROM CypressBlogBundle:Tag t'
        );
        $tags = $query->getResult();

        return $this->render('CypressBlogBundle:Blog:tags.html.twig', array(
            'tags' => $tags
        ));
    }


    /**
     * Tag Controller
     */
    public function tagAction($slug)
    {
        $em = $this->getEm();
        $query = new Query($em);
        $query->setDQL(
            'SELECT t
                FROM CypressBlogBundle:Tag t WHERE t.slug = ?1'
        );
        $query->setParameter(1, $slug);
        $tag = $query->getSingleResult();

        

        return $this->render('CypressBlogBundle:Blog:tag.html.twig', array(
            'tag' => $tag,
            'posts' => $tag->getPosts()
        ));
    }
}
