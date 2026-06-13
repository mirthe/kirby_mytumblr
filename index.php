<?php

Kirby::plugin('mirthe/mytumblr', [
    'options' => [
        'apiKey' => option('tumblr.apiKey'),
        'domain' => option('tumblr.domain'),
        'limit' => 30,
        'cache' => true
    ],
    'translations' => [
        'nl' => [
            'mirthe.mytumblr.read-article' => 'Artikel lezen',
            'mirthe.mytumblr.watch-video' => 'Video bekijken',
            'mirthe.mytumblr.open-link' => 'Link openen',
            'mirthe.mytumblr.open-post' => 'Bericht openen',
            'mirthe.mytumblr.reblog' => 'Reblog',
            'mirthe.mytumblr.post-type-unknown' => 'Post type {{type}} onbekend'
        ],
        'en' => [
            'mirthe.mytumblr.read-article' => 'Read article',
            'mirthe.mytumblr.watch-video' => 'Watch video',
            'mirthe.mytumblr.open-link' => 'Open link',
            'mirthe.mytumblr.open-post' => 'Open post',
            'mirthe.mytumblr.reblog' => 'Reblog',
            'mirthe.mytumblr.post-type-unknown' => 'Post type {{type}} unknown'
        ]
    ],
    'snippets' => [
        'tumblr-posts' => __DIR__ . '/snippets/posts.php'
    ]
]);
