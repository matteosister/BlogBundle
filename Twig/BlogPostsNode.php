<?php

/*
 * matteosister
 * just for fun...
 */

namespace Cypress\BlogBundle\Twig;

class BlogPostsNode extends \Twig_Node 
{
    public function __construct($lineno, $tag)
    {
        parent::__construct(array(), array(), $lineno, $tag);
    }
    
    public function compile (\Twig_Compiler $compiler)
    {
        $compiler->write('posts');
    }
}