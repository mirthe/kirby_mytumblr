<?php
$caption = $post->caption ?? '';
echo "<img class='block--img' src='{$photoUrl}' alt='' loading='lazy'>
    <div class='block--body'>
        <div class='caption'>{$caption}</div>
        <time><a href='{$post->post_url}'>{$prettydate}</a></time>
    </div>";
