<?php

namespace Bundle\BlogBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class BlogBundle extends Bundle
{
    /**
     * Boots the Bundle.
     */
    public function boot()
    {
        parent::boot();
    }
    /**
    * Generatore di url
    *
    * @param string $text
    * @return string per url
    */
    public static function slugify($text)
    {
        // sostituisce tutto ciò che non sia una lettera o un numero con -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // toglie gli spazi
        $text = trim($text, '-');

        // translitterazione
        if (function_exists('iconv'))
        {
          $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }

        // minuscolo
        $text = strtolower($text);

        // toglie i caratteri indesiderati
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text))
        {
          $text = 'n-a';
        }

        return $text;
    }
}