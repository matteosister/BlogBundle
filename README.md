------------
Installation
------------

* Add this bundle as a git submodule with:

    $ git submodule add git://github.com/matteosister/BlogBundle.git src/Cypress/BlogBundle

* Add the "Cypress" namespace in your autoload file

    //app/autoload.php
    $loader->registerNamespaces(array(
        ...
        'Cypress'          => __DIR__.'/../src',
    ));

* Add this bundle to your application's **kernel file**:

    //app/ApplicationKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new Cypress\BlogBundle\CypressBlogBundle(),
            // ...
        );
    }

* Import the DI services (see todo)
    
    //app/config.yml
    imports:
        - { resource: "@CypressBlogBundle/Resources/config/services.xml" }

* If you have already the **BluePrintBundle** (http://symfony2bundles.org/sonata-project/BluePrintBundle) skip this step.
If not add also that bundle as a submodule in your project

    $ git submodule add https://github.com/sonata-project/BluePrintBundle.git src/Bundle/BluePrintBundle

and add the relative line in the AppKernel.php

    //app/ApplicationKernel.php
        public function registerBundles()
        {
            return array(
                // ...
                new Bundle\BluePrintBundle\BluePrintBundle(),
                // ...
            );
        }

* Publish assets from both the bundles. From the root of your project:

    $ ./app/console publish:assets --symlink web/

* In your main routing file add the reference to the blog specific **routings**:

    //app/config/routing.yml
    blog:
        resource: BlogBundle/Resources/config/routing.yml
        prefix: /blog

skip the **prefix** part if you want your homepage to be the blog homepage

* **rebuild the model**

    $ ./app/console doctrine:generate:entities

* **update your schema**

    $ (if you want to see the queries) ./app/console doctrine:schema:update --dump-sql
    $ ./app/console doctrine:schema:update --force

* insert **fixtures** to have some data to play with

    $ ./app/console doctrine:data:load

---------

Main features:

    - twig templates
    - blueprint css framework
    - doctrine2 with annotations
    - 4 model classes (post, category, tag and comment)

TODO:
    - Controller as service
    - Add DependencyInjection Resource loader
    - So many things....but this is just for fun!