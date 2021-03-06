<?php

namespace SilexBlog;

require_once __DIR__.'/Post.php';

class PostFactory
{
    public static function create($poster_name, $title, $body) {
        // This function returns a post object for a post just written, so use the current time.
        $current_time = time();

        // The post hasn't been persisted yet, so the id is null as that is assigned by the database.
        return new Post(null, $poster_name, $title, $current_time, $current_time, $body);
    }
}