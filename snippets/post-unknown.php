<?php
echo "<div class='block--body'>
        <h2>" . str_replace('{{type}}', htmlspecialchars($post->type, ENT_QUOTES), t('mirthe.mytumblr.post-type-unknown')) . "</h2>
        <time><a href='{$post->post_url}'>{$prettydate}</a></time>
        <p><a href='{$post->post_url}'>" . t('mirthe.mytumblr.open-post') . "</a></p>
    </div>";
