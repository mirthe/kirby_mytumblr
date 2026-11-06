<?php
if (property_exists($post, 'photos')) {
    echo "<a href='{$post->url}'>
            <img class='block--img' src='{$post->photos[0]->original_size->url}' alt='' loading='lazy'>
        </a>";
} else {
    echo "<a href='{$post->url}' class='block--fallback'></a>";
}

echo "<div class='block--body'>
        <h2>{$post->summary}</h2>
        <time><a href='{$post->post_url}'>{$prettydate}</a></time>
        <p>{$post->excerpt}</p>
        <p>{$post->description}</p>
        <p><a href='{$post->url}'>" . t('mirthe.mytumblr.read-article') . "</a></p>
    </div>";
