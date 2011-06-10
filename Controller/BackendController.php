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

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }
    
    public function dashboardAction()
    {
        return $this->container->get('templating')->renderResponse('CypressBlogBundle:Backend:Pages/dashboard.html.twig');
    }
}