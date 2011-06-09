<?php

namespace Cypress\BlogBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class CypressBlogBundle extends Bundle
{
    /**
     * Boots the Bundle.
     */
    public function boot()
    {
        parent::boot();
    }
}