<?php include('getposts.php'); ?>

<div class="masonry">
<?php $i = 0;
    foreach($mypostsdata as $post) {

        $mooiedatum = date('d M Y', $post->timestamp);

        echo '<div class="block block--tumblr tumblr-'.$post->type.'">'. "\n";
        
        if ($post->type == 'link') {
            if (property_exists($post,'photos'))
                {echo "<a href='{$post->url}'><img class='block--img' src='{$post->photos[0]->original_size->url}' alt='' loading='lazy'></a>";}
            else {echo "<a href='{$post->url}' class='block--fallback'></a>";}

            echo "<div class='block--body'>
                <h2>{$post->summary}</h2>
                <time><a href='{$post->post_url}'>{$mooiedatum}</a></time>
                <p>{$post->excerpt}</p>
                <p>{$post->description}</p> 
                <p><a href='{$post->url}'>Artikel lezen</a></p>
            </div>";
            // TODO excerpt en desc alleen als die niet leeg zijn..
        }
        
        elseif ($post->type == 'photo') {
            $photo = ($post->photos[0]->alt_sizes[2]->url);
            echo "<img class='block--img' src='{$photo}' alt='' loading='lazy'>
            <div class='block--body'>
                <div class='caption'>{$post->caption}</div>    
                <time><a href='{$post->post_url}'>{$mooiedatum}</a></time>
            </div>";
        } 
          
        elseif ($post->type == 'video') {
            // $video = $post->player[0]->embed_code;
            $caption = strip_tags($post->caption);
            if (property_exists($post,'permalink_url')){
                echo "<a href='{$post->permalink_url}'><img class='block--img' src='{$post->thumbnail_url}' alt='' loading='lazy'></a>";
            }
            else {echo "<div class='block--fallback'></div>";
                $post->permalink_url = $post->post_url;}
            echo "<div class='block--body'>
                <h2>{$caption}</h2>
                <time><a href='{$post->post_url}'>{$mooiedatum}</a></time>
                <p><a href='{$post->permalink_url}'>Video bekijken</a></p>
            </div>";
        } 

        elseif ($post->type == 'text') {

            if ($post->reblog_key !== ''){
                echo "<div class='block--body'>
                    <h2>Reblog</h2>
                    <time><a href='{$post->post_url}'>{$mooiedatum}</a></time>
                    {$post->trail[0]->content}
                    <div class='caption'>{$post->reblog->comment}</div>
                    <a href='{$post->post_url}'>Bericht openen</a>
                </div>"; 
            } 
            
            else {
                echo "<div class='block--body'>
                    <h2>{$post->title}</h2>
                    <time><a href='{$post->post_url}'>{$mooiedatum}</a></time>
                    <div class='caption'>{$body}</div>
                    <a href='{$post->post_url}'><i class='fa fa-external-link' aria-hidden='true'></i></a>
                </div>";
            }
        } 

        elseif ($post->type == 'quote') {
            echo "<div class='block--body'>
                <time><a href='{$post->post_url}'>{$mooiedatum}</a></time>
                <blockquote class='blockquote'>
                    <p >\"{$post->text}\"</p>
                    <div class='blockquote-footer text-left'>{$post->source}</cite></div>
                </blockquote>
            </div>";
        }  
          
        else {echo "<div class='block--body'>
                <h2>Post type {$post->type} onbekend</h2>
                <time><a href='{$post->post_url}'>{$mooiedatum}</a></time>
                <p><a href='{$post->post_url}'>Bericht openen</a></p>
            </div>";
        }

        echo "</div>";

    }
?>
</div>