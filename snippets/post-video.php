<?php
$caption = strip_tags($post->caption);
if (property_exists($post, 'permalink_url')) {
    echo "<a href='{$post->permalink_url}'>
        <img class='block--img' src='{$post->thumbnail_url}' alt='' loading='lazy'>
    </a>";
} else {
    echo "<div class='block--fallback'></div>";
    $post->permalink_url = $post->post_url;
}
echo "<div class='block--body'>
        <h2>{$caption}</h2>
        <time><a href='{$post->post_url}'>{$prettydate}</a></time>
        <p><a href='{$post->permalink_url}'>" . t('mirthe.mytumblr.watch-video') . "</a></p>
    </div>";
