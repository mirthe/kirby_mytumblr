<?php

Kirby::plugin('mirthe/mytumblr', [
    'options' => [
        'apiKey' => option('tumblr.apiKey'),
        'domain' => option('tumblr.domain'),
        'limit' => 30
    ],
    'snippets' => [
        'tumblr-posts' => __DIR__ . '/snippets/posts.php'
    ]
]);
