<?php
echo "<div class='block--body'>
        <time><a href='{$post->post_url}'>{$prettydate}</a></time>
        <blockquote class='blockquote'>
            <p>\"{$post->text}\"</p>
            <div class='blockquote-footer text-left'>{$post->source}</cite></div>
        </blockquote>
    </div>";
