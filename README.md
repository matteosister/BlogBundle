------------
Installation
------------

1) Add this bundle as a git submodule with:

    $ git submodule add git://github.com/matteosister/BlogBundle.git src/Bundle/BlogBundle

2) Add this bundle to your application's kernel file:

    //app/ApplicationKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new Bundle\BlogBundle\BlogBundle(),
            // ...
        );
    }

3) If you have already the BluePrintBundle skip this step. If not add also that bundle as a submodule in your project

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

4) Publish assets from both the bundles. From the route of your project:

    $ ./app/console publish:assets --symlink web/

5) add a block named header in the \<head\> section of your main template file:

    //app/views/layout.twig
    <head>
        // ...
        {% block header %}{% endblock %}
        // ...
    </head>

6) In your main routing file add the reference to the blog specific routings:

    //app/config/routing.yml
    blog:
        resource: BlogBundle/Resources/config/routing.yml

---------
that's it
---------

Now, in your browser, go to http://foo.bar/blog

Main features:


    * twig templates with blueprint css framework (just because I'm lazy)
    * doctrine2 with annotations
    * 4 model classes (post, category, tag and comment)
    * fixtures to load dummy data

TODO:
    - so many things....but this is just for fun!