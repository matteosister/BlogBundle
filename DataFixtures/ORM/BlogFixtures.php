<?php
/* 
 *  Matteo Giachino <m.giachino@vivacom.com>
 *  Vivacom 2011
 *  Just for fun...
 */

use Doctrine\Common\DataFixtures\FixtureInterface;
use Application\BlogBundle\Entity\Post;
use Application\BlogBundle\Entity\Category;
use Application\BlogBundle\Entity\Tag;
use Application\BlogBundle\Entity\Comment;

class BlogFixtures implements FixtureInterface {

    private $objects;

    /**
     * fixture load
     */
    public function load($manager)
    {
        $this->generatePosts();

        foreach($this->objects as $object)
            $manager->persist($object);
    }

    private function generatePosts()
    {
        $category1 = new Category();
        $category1->setName('Categoria 1');

        $category2 = new Category();
        $category2->setName('Categoria 2');

        $tag1 = new Tag();
        $tag1->setLabel('pippo');

        $tag2 = new Tag();
        $tag2->setLabel('pluto');

        $tag3 = new Tag();
        $tag3->setLabel('paperino');

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
        $comment->setUser('pippo');
        $comment->setTheText($this->generateLoremIpsum());
        $comment->setDate(new DateTime('2011-02-'.rand(1,31)));
        return $comment;
    }

    private function generateRandomPost($num)
    {
        $post = new Post();
        $post->setTitle('Hello World '.rand(1,10000).'!');
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

