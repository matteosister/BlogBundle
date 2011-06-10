<?php

/*
 * matteosister
 * just for fun...
 */

namespace Cypress\BlogBundle\Twig;

use Cypress\BlogBundle\Twig\PostsParser;

class BlogTags extends \Twig_Extension
{
    
    protected $environement;
    
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environement = $environment;
    }
    
    public function getTokenParsers() {
        return array(
            new PostsParser()
        );
    }
    
    public function getName() {
        return 'cypress_blog';
    }
}