<?php include_once('getposts.php'); ?>

<div class="masonry">
    <?php $i = 0;
foreach ($mypostsdata as $post) {
    $prettydate = date('d M Y', $post->timestamp);

    // include('getpost.php');
    
    echo '<div class="block block--tumblr tumblr-'.$post->type.'">'. "\n";
        
    if ($post->type == 'link') {
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
                <p><a href='{$post->url}'>Artikel lezen</a></p>
            </div>";
    } elseif ($post->type == 'photo') {
        $photo = ($post->photos[0]->alt_sizes[2]->url);
        echo "<img class='block--img' src='{$photo}' alt='' loading='lazy'>
            <div class='block--body'>
                <div class='caption'>{$post->caption}</div>
                <time><a href='{$post->post_url}'>{$prettydate}</a></time>
            </div>";
    } elseif ($post->type == 'video') {
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
                <p><a href='{$post->permalink_url}'>Video bekijken</a></p>
            </div>";
    } elseif ($post->type == 'text') {

        if ($post->reblog_key !== '') {
            if ($post->reblog->tree_html == ""){
                
                // super hacky implementation of new nested block format..
                // only a problem for youtube atm
                // Tumblr Neue Post Format (NPF)
                // need to rework this, might use getpost.php
                
                //print_r($post);

                preg_match_all("#(?<=v=|v\/|vi=|vi\/|youtu.be\/)[a-zA-Z0-9_-]{11}#", $post->reblog->comment, $youtubeid);
                
                if (!empty ($youtubeid[0])) {
                    echo "<a href='{$post->post_url}'>
                        <img class='block--img' src='https://img.youtube.com/vi/". $youtubeid[0][0] ."/hqdefault.jpg' alt='' loading='lazy'>
                    </a>";
                } else {
                    echo "<div class='block--fallback'></div>";
                    $post->permalink_url = $post->post_url;
                }
                echo "<div class='block--body'>
                        <h2>{$post->summary}</h2>
                        <time><a href='{$post->post_url}'>{$prettydate}</a></time>
                        <p><a href='{$post->post_url}'>Video bekijken</a></p>
                    </div>";}
            else {
                echo "<div class='block--body'>
                    <h2>Reblog</h2>
                    <time><a href='{$post->post_url}'>{$prettydate}</a></time>
                    {$post->trail[0]->content}
                    <div class='caption'>{$post->reblog->comment}</div>
                    <a href='{$post->post_url}'>Bericht openen</a>
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
    } elseif ($post->type == 'quote') {
        echo "<div class='block--body'>
                <time><a href='{$post->post_url}'>{$prettydate}</a></time>
                <blockquote class='blockquote'>
                    <p >\"{$post->text}\"</p>
                    <div class='blockquote-footer text-left'>{$post->source}</cite></div>
                </blockquote>
            </div>";
    } else {
        echo "<div class='block--body'>
                <h2>Post type {$post->type} onbekend</h2>
                <time><a href='{$post->post_url}'>{$prettydate}</a></time>
                <p><a href='{$post->post_url}'>Bericht openen</a></p>
            </div>";
    }

    echo "</div>";
}
?>
</div>
