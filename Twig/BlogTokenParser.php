<?php

/*
 * matteosister
 * just for fun...
 */

namespace Cypress\BlogBundle\Twig;

use \Twig_TokenParser;
use Cypress\BlogBundle\Twig\BlogPostsNode;

class BlogTokenParser extends \Twig_TokenParser {
    
    public function parse(\Twig_Token $token) {
        $lineno = $token->getLine();
        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);
        $this->parser->getStream()->expect(\Twig_Token::BLOCK_START_TYPE);
        $value = $this->parser->getExpressionParser()->parseExpression();        
        $node = new BlogPostsNode($value, $lineno, $this->getTag());
        return $node;
    }
    
    public function getTag() {
        return 'posts';
    }
}