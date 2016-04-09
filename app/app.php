<?php

// Load 3rd party libraries using composer.
require_once __DIR__.'/../vendor/autoload.php';

// Load our custom Application class that also loads other required classes.
require_once __DIR__.'/SilexBlog/SilexBlogApplication.php';

// Instantiate the Silex service container (the application)
$app = new SilexBlog\SilexBlogApplication();
// Enable debugging so that errors are displayed via web pages.
$app['debug'] = true;

// Register a twig service provider with the path to the twig templates given.
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

// Register a doctrine provider with the MySQL connection parameters given.
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'   => 'pdo_mysql',
        'host'     => 'localhost',
        'dbname'   => 'silex_blog',
        'port'     => 3306,
        'username' => 'root',
        'password' => '',
        'charset'   => 'utf8mb4',
    ),
));

// A controller to process the route /blog/
$app->get('/blog/', function () use ($app) {
    // Use the static function Post::getAll to get all the posts in the database.
    $posts = SilexBlog\Post::getAll($app);
    
    // Set the page title variable.
    $page_title = 'List of All the Blog Posts';

    // Pass the page title and posts to twig to be rendered using the list_posts.twig template.
    return $app->render('list_posts.twig', array('page_title' => $page_title, 'posts' => $posts));
});

// A controller to process the route /blog/id/{id} where id is a post id.
// Example: /blog/4
$app->get('/blog/id/{id}', function ($id) use ($app) {
    // Use the static function Post::getById to get the specified post by its id.
    $post = SilexBlog\Post::getById($app, $id);

    // Set the page title to the blog post title and author
    $page_title = $post->getTitle() . ' by ' . $post->getAuthor();

    // Pass the page title and post to twig to be rendered using the list_posts.twig template.
    return $app->render('list_posts.twig', array('page_title' => $page_title, 'posts' => array($post)));
});

// A controller to process the route for /blog/author/{author} where author is the post author.
// YOUR CODE HERE

// HINTS:
// Look at the /blog/id/{id} route to see how to specify the route.  Since you will be getting
// multiple posts, use a $app->render call like the one used in the /blog/ route that lists
// all the blog posts.
//
// You will need to add a getByAuthor method to the Post class.

// Return the service container used by web/index.php
return $app;