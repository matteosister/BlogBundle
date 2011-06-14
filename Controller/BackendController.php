<?php

/*
 * @matteosister
 * https://github.com/matteosister
 * Just for fun...
 */

namespace Cypress\BlogBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BackendController extends ContainerAware 
{
    /**
     * @var Symfony\Component\DependencyInjection\ContainerInterface 
     */
    protected $container;
    
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }
    
    private function getEm()
    {
        if ($this->em == null) {
            $this->em = $this->container->get('doctrine')->getEntityManager();
        }
        
        return $this->em;
    }
    
    /**
     * Route("/", name="dashboard")
     */
    public function dashboardAction()
    {
        return $this->container->get('templating')->renderResponse('CypressBlogBundle:Backend:Pages/dashboard.html.twig');
    }
    
    /**
     * Route("/posts", name="posts")
     */
    public function postsAction()
    {
        $posts = $this->getEm()->getRepository('Cypress\BlogBundle\Entity\Post')->findAll();
        return $this->container->get('templating')->renderResponse('CypressBlogBundle:Backend:Pages/posts.html.twig', array(
            'posts' => $posts
        ));
    }
}