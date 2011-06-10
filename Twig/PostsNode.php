<?php

/*
 * matteosister
 * just for fun...
 */

namespace Cypress\BlogBundle\Twig;

class PostsNode extends \Twig_Node 
{
    public function __construct($preContent, $postContent, $lineno, $tag)
    {
        parent::__construct(array(), array(
            'pre_content' => $preContent,
            'post_content' => $postContent
        ), $lineno, $tag);
    }
    
    public function compile (\Twig_Compiler $compiler)
    {
        $compiler->addDebugInfo($this);
        
        if ($this->getAttribute('pre_content') != null) {
            $compiler
                ->write('echo \''.$this->getAttribute('pre_content').'\'')
                ->raw(";\n");
        }
        
        if ($this->getAttribute('post_content') != null) {
            $compiler
                ->write('echo \''.$this->getAttribute('post_content').'\'')
                ->raw(";\n");
        }
            //->write('echo "'.$this->getAttribute('content').'"')
            //->raw(";\n");
    }
}