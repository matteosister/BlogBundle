<?php

/*
 * @matteosister
 * https://github.com/matteosister
 * Just for fun...
 */

namespace Cypress\BlogBundle\Entity;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Cypress\BlogBundle\Entity\Post;
use Cypress\BlogBundle\Entity\Category;
use Cypress\BlogBundle\Entity\Tag;

class EntitiesListener implements EventSubscriber {
    
    /**
     * @var \Cypress\BlogBundle\Util\UrlizerInterface
     */
    private $urlizer;
    
    /**
     * @var ContainerInterface
     */
    private $container;
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    public function getSubscribedEvents() {
        return array(
            Events::prePersist
        );
    }
    
    public function prePersist(LifecycleEventArgs $args)
    {
        if (null === $this->urlizer) {
            $this->urlizer = $this->container->get('cypress_blog.urlizer');
        }
        $entity = $args->getEntity();
        if ($entity instanceof Post) {
            $entity->setSlug($this->urlizer->slugify($entity->getTitle()));
        }
        if ($entity instanceof Category) {
            $entity->setSlug($this->urlizer->slugify($entity->getName()));
        }
        if ($entity instanceof Tag) {
            $entity->setSlug($this->urlizer->slugify($entity->getLabel()));
        }
    }
}