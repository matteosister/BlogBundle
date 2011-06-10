<?php
/* 
 *  Matteo Giachino <m.giachino@vivacom.com>
 *  Vivacom 2011
 *  Just for fun...
 */

namespace Cypress\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Cypress\BlogBundle\Entity\Post;
use Cypress\BlogBundle\Entity\Category;
use Cypress\BlogBundle\Entity\Tag;
use Cypress\BlogBundle\Entity\Comment;
use \DateTime;
use Cypress\BlogBundle\Entity\EntitiesListener;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BlogFixtures implements FixtureInterface, ContainerAwareInterface 
{
    private $container;
    private $objects;
    
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    /**
     * fixture load
     */
    public function load($manager)
    {
        $urlizer = new EntitiesListener($this->container);
        $manager->getEventManager()->addEventSubscriber($urlizer);
        $this->generatePosts();
        if ($this->objects == null) return;
        foreach($this->objects as $object) {
            $manager->persist($object);
        }
        $manager->flush();
    }

    private function generatePosts()
    {
        $category1 = new Category();
        $category1->setName('Category 1');

        $category2 = new Category();
        $category2->setName('Category 2');

        $tag1 = new Tag();
        $tag1->setLabel('linux');

        $tag2 = new Tag();
        $tag2->setLabel('symfony2');

        $tag3 = new Tag();
        $tag3->setLabel('php');

        $comment1 = $this->generateRandomComment();
        $comment2 = $this->generateRandomComment();
        $comment3 = $this->generateRandomComment();
        $comment4 = $this->generateRandomComment();

        $comment2->setParent($comment1);

        $post1 = new Post();
        $post1 = $this->generateRandomPost(1);
        $post1->setCategory($category1);
        $post1->addTags($tag1);
        $post1->addTags($tag2);
        $post1->addTags($tag3);
        $post1->addComments($comment1);
        $post1->addComments($comment2);
        $post1->addComments($comment3);

        $post2 = new Post();
        $post2 = $this->generateRandomPost(2);
        $post2->setCategory($category2);
        $post2->addTags($tag2);
        $post2->addComments($comment4);

        $this->objects[] = $post1;
        $this->objects[] = $post2;
    }

    private function generateRandomComment()
    {
        $comment = new Comment();
        $comment->setUser('Mickey Mouse');
        $comment->setTheText($this->generateLoremIpsum());
        $comment->setDate(new DateTime('2011-02-'.rand(1,31)));
        return $comment;
    }

    private function generateRandomPost($num)
    {
        $post = new Post();
        $post->setTitle('The title of the post '.$num);
        $post->setAbstract($this->generateLoremIpsum());
        $post->setTheText($this->generateLoremIpsum(5));
        $post->setDate(new DateTime('2011-01-'.rand(1,31)));
        return $post;
    }

    private function generateLoremIpsum($num = 1)
    {
        return str_repeat('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ornare scelerisque ipsum sodales
            facilisis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
            Fusce nulla risus, porttitor at blandit et, commodo eu est. Maecenas venenatis ante ut massa accumsan
            sollicitudin. Phasellus sagittis libero sed turpis bibendum sollicitudin. Sed aliquam, sapien a sodales porttitor,
            est magna malesuada neque, nec dignissim dolor risus nec nunc. Sed nisi nisl, mollis dapibus imperdiet
            ac, commodo eu quam.',
            $num);
    }
}

