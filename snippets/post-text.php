<?php
if ($post->reblog_key !== '') {
    if ($post->reblog->tree_html == "") {
        preg_match_all("#(?<=v=|v\/|vi=|vi\/|youtu.be\/)[a-zA-Z0-9_-]{11}#", $post->reblog->comment, $youtubeid);

        if (!empty($youtubeid[0])) {
            echo "<a href='{$post->post_url}'>
                <img class='block--img' src='https://img.youtube.com/vi/" . $youtubeid[0][0] . "/hqdefault.jpg' alt='' loading='lazy'>
            </a>";
            $post->linktekst = t('mirthe.mytumblr.watch-video');
        } else {
            echo "<div class='block--fallback'></div>";
            $post->permalink_url = $post->post_url;
            $post->linktekst = t('mirthe.mytumblr.open-link');
        }
        echo "<div class='block--body'>
                <h2>{$post->summary}</h2>
                <time><a href='{$post->post_url}'>{$prettydate}</a></time>
                <p><a href='{$post->post_url}'>{$post->linktekst}</a></p>
            </div>";
    } else {
        echo "<div class='block--body'>
            <h2>" . t('mirthe.mytumblr.reblog') . "</h2>
            <time><a href='{$post->post_url}'>{$prettydate}</a></time>
            {$post->trail[0]->content}
            <div class='caption'>{$post->reblog->comment}</div>
            <a href='{$post->post_url}'>" . t('mirthe.mytumblr.open-post') . "</a>
        </div>";
    }
} else {
    echo "<div class='block--body'>
        <h2>{$post->title}</h2>
        <time><a href='{$post->post_url}'>{$prettydate}</a></time>
        <div class='caption'>{$body}</div>
        <a href='{$post->post_url}'><i class='fa-regular fa-external-link' aria-hidden='true'></i></a>
    </div>";
}
