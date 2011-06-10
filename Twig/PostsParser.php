<?php

/*
 * matteosister
 * just for fun...
 */

namespace Cypress\BlogBundle\Twig;

use \Twig_TokenParser;
use Cypress\BlogBundle\Twig\PostsNode;

class PostsParser extends \Twig_TokenParser {
    
    public function parse(\Twig_Token $token) {
        $lineno = $token->getLine();
        
        $stream = $this->parser->getStream();
        
        $stream->expect(\Twig_Token::BLOCK_END_TYPE);
        if ($stream->test(\Twig_Token::TEXT_TYPE)) {
            $preContent = $stream->expect(\Twig_Token::TEXT_TYPE)->getValue();
        } else {
            $preContent = null;
        }
        $stream->expect(\Twig_Token::VAR_START_TYPE);
        $stream->expect(\Twig_Token::NAME_TYPE);
        $stream->expect(\Twig_Token::VAR_END_TYPE);
        if ($stream->test(\Twig_Token::TEXT_TYPE)) {
            $postContent = $stream->expect(\Twig_Token::TEXT_TYPE)->getValue();
        } else {
            $postContent = null;
        }
        $stream->expect(\Twig_Token::BLOCK_START_TYPE);
        $stream->expect(\Twig_Token::NAME_TYPE);
        $stream->expect(\Twig_Token::BLOCK_END_TYPE);
        
        $node = new PostsNode($preContent, $postContent, $lineno, $this->getTag());

        return $node;
    }
    
    public function getTag() {
        return 'posts';
    }
}