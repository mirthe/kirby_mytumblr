<?php

Kirby::plugin('mirthe/mytumblr', [
    'options' => [
        'apiKey' => option('tumblr.apiKey'),
        'domain' => option('tumblr.domain'),
        'limit' => 30,
        'cache' => true
    ],
    'snippets' => [
        'tumblr-posts' => __DIR__ . '/snippets/posts.php'
    ]
]);
