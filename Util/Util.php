<?php

/*
 * @matteosister
 * https://github.com/matteosister
 * Just for fun...
 */

namespace Cypress\BlogBundle\Util;

class Util implements UrlizerInterface {
    public function slugify($text) {
        
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