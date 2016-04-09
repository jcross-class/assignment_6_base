Assignment 6
============

Purpose
-------
* Learn how to use Silex to respond to HTTP GET requests, render HTML, and access a MySQL DB.
* Learn how PHP name spacing works.
* Learn how traits and anonymous functions are used in Silex.

Collaboration
-------------
You can talk about the assignment with your peers in the class.  However, you should perform the work yourself and turn in a copy of your work.

Prerequisites
-------------
Nothing new.  You will use git, PhpStorm, MySQL, and MySQL Workbench for this assignment.

Use git to clone your private assignment 6 repo to your computer.  Then in PhpStorm, use `File->Open Directory` and select your local repo.

You will be using the web server built into PHP.  See the Part 2 instructions for how to set that up.

Resources and Examples
----------------------
* The official Silex [documentation](http://silex.sensiolabs.org/documentation).
* The official PHP [documentation](http://php.net/manual/en/language.namespaces.php) for name spaces.
* The official PHP [documentation](http://php.net/manual/en/functions.anonymous.php) for anonymous functions (aka. closures).

Instructions
------------
There are 2 parts to this assignment.

### Part 1
You need to read through the PHP code found in your git repo and answer the following questions:

1. What is the PHP namespace that is used for all our custom application classes?

2. What service provider are we using to interact with the database?

3. What service provider are we using to render HTML?

4. What is a route?

5. How do you capture parameters specified in a route URL?

6. What is the purpose of the `use` keyword in the following code?
    ```
    // A controller to process the route /blog/
    $app->get('/blog/', function () use ($app) {
        // Use the static function Post::getAll to get all the posts in the database.
        $posts = SilexBlog\Post::getAll($app);

        // Set the page title variable.
        $page_title = 'List of All the Blog Posts';

        // Pass the page title and posts to twig to be rendered using the list_posts.twig template.
        return $app->render('list_posts.twig', array('page_title' => $page_title, 'posts' => $posts));
    });
    ```

7. For the following code, why is there a `\` in front of `Exception`?
   ```
    namespace SilexBlog;
    class PostNotFoundException extends \Exception {}
   ```

8. For the following code, is this a call to an instance method or a static method?
    ```
    $post = SilexBlog\Post::getById($app, $id);
    ```

#### How to Turn in Part 1
You can turn in part 1 by putting your answer file or files into your git repo or through the D2L dropbox.

### Part 2
You need to add a route that will list all the posts for a given author.  There are `YOUR CODE HERE` sections to help you along.

#### Files and their purpose
* `web/index.php` - the PHP file that is run by any request to the PHP application.  `web` is the document root.  `index.php` uses `require_once` to get an instance of SilexBlogApplication which is then used to handle all requests.
* `app/app.php` - the PHP file that is required by `web/index.php`.  It creates the services container and returns it to `web/index.php`.  The service container is defined and set up in this file.
* `app/SilexBlog/SilexBlogApplication.php` - includes the PHP files for the models.  Defines a new class extended from `SilexApplication` that uses the twig trait for HTML rendering.
* `models/SilexBlog/Post.php` - a class that represents a blog post.
* `models/SilexBlog/PostFactory.php` a factory to create new `Post` objects.
* `resources/silex_blog.sql` - the SQL file that creates the `silex_blog` database with the `posts` table and some sample posts.
* `views/list_posts.twig` - a twig template used to render the blog posts.
* `vendor` - a directory containing the 3rd party PHP libraries downloaded by composer.

#### Instructions to set up the application
First you need to set up the `silex_blog` database and the `posts` table.  Start MySQL using the XAMPP control panel.  Then use MySQL Workbench to connect to it.  Go to `File->Run SQL Script..` and select the file `resources/silex_blog.sql`. Go through all the prompts until it is finished running the SQL file.  On the left side of the window under `Schemas` click the refresh button.  You should see a database named `silex_blog`.

Next you need to set up PhpStorm.  We will be using the built-in PHP CGI server for this assignment.  You will need PHP 5.4 or greater to do this.  You should be using the XAMPP PHP version 5.6 as that is how I've tested this project.

You need to set up PhpStorm to run the PHP CGI server.  To do so, first make sure you have the git repo open in PhpStorm by using the Open Directory menu item under File in PhpStorm (`File->Open Directory`).  Next go to `Run->Edit Configurations...` Click the green `+` to create a new configuration.  Select `PHP Built-in Web Server`.  Change the name to `Blog`.  Leave host as `localhost`.  Set the port to `8080`.  Set the `Document root` and the `Custom working directory` to the `web` directory by clicking the `...` button next to those fields and using the file chooser to select it.  Check the `Use router script` and then use the `...` button to select `web/index.php`.  If there is a red ! icon near the bottom right of the window, click the `Fix` button and specify your PHP interpreter.  Once done, click `Ok` to exit the Edit Configurations window.  Next hit the green run button to start the PHP CGI web server.  Then go to your web browser and enter this url [http://localhost:8080/blog/](http://localhost:8080/blog/).  You should see a list of blog posts.  Note that you can click on the title of a blog post to see just that post.  You can also click on an author.  However, that won't work right now, as that is the route you need to add to complete the assignment.

#### How to Turn in Part 2
You need to clone your private git repo for assignment 6 to your computer and make the required changes.  Once you are done, commit your modifications to your master branch and push them to GitHub.  Then go to D2L and turn in the assignment to let me know I can go look at your repo and grade you.  D2L requires you to upload a file, so just upload a blank file or one with a link to your git repo in github.

Grading
-------
Points|Part|Requirement
------|----|-----------
2 | 1 | Question 1
2 | 1 | Question 2
2 | 1 | Question 3
2 | 1 | Question 4
2 | 1 | Question 5
2 | 1 | Question 6
2 | 1 | Question 7
2 | 1 | Question 8
10 | 2 | `app.php` - working route for posts by an author
10 | 2 | `post.php` - working method to get posts by an author
5 | 2 | Turn in part 2 via github.
**41**| | **Total**
