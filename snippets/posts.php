<?php include_once('getposts.php'); ?>

<div class="masonry">
    <?php foreach ($mypostsdata as $post) {
        $prettydate = date('d M Y', $post->timestamp);
        $postType = $post->type;
        $photoUrl = null;

        if ($post->type === 'photo' || $post->type === 'text') {
            $photoUrl = $post->photos[0]->alt_sizes[2]->url
                ?? $post->photos[0]->original_size->url
                ?? $post->photos[0]->url
                ?? null;

            if ($photoUrl === null && isset($post->content) && is_array($post->content)) {
                foreach ($post->content as $block) {
                    if (($block->type ?? null) === 'image' && isset($block->media[0]->url)) {
                        $photoUrl = $block->media[0]->url;
                        break;
                    }
                }
            }

            if ($photoUrl === null && $post->type === 'text') {
                $htmlContent = [$post->body ?? '', $post->reblog->comment ?? '', $post->reblog->tree_html ?? ''];
                foreach ($post->trail ?? [] as $trailItem) {
                    $htmlContent[] = $trailItem->content ?? '';
                }

                foreach ($htmlContent as $html) {
                    if (preg_match('/<img\b[^>]*\bsrc=["\']([^"\']+)["\']/i', $html, $imageMatch)) {
                        $photoUrl = html_entity_decode($imageMatch[1], ENT_QUOTES | ENT_HTML5);
                        break;
                    }
                }
            }

            if ($post->type === 'text' && $photoUrl !== null) {
                $hasText = trim(html_entity_decode(strip_tags($post->title ?? ''), ENT_QUOTES | ENT_HTML5)) !== ''
                    || trim(html_entity_decode(strip_tags($post->body ?? ''), ENT_QUOTES | ENT_HTML5)) !== ''
                    || trim(html_entity_decode(strip_tags($post->reblog->comment ?? ''), ENT_QUOTES | ENT_HTML5)) !== '';

                if (!$hasText && isset($post->content) && is_array($post->content)) {
                    foreach ($post->content as $block) {
                        if (($block->type ?? null) === 'text' && trim(strip_tags($block->text ?? '')) !== '') {
                            $hasText = true;
                            break;
                        }
                    }
                }

                if (!$hasText) {
                    foreach ($post->trail ?? [] as $trailItem) {
                        if (trim(html_entity_decode(strip_tags($trailItem->content ?? ''), ENT_QUOTES | ENT_HTML5)) !== '') {
                            $hasText = true;
                            break;
                        }
                    }
                }

                if (!$hasText) {
                    $postType = 'photo';
                }
            }
        }

        $tags = array_map('strtolower', $post->tags ?? []);
        $largeClass = in_array('large', $tags, true) ? ' block--tumblr-large' : '';
        echo '<div class="block block--tumblr tumblr-' . $postType . $largeClass . '">' . "\n";

        $postSnippets = [
            'link' => 'post-link.php',
            'photo' => 'post-photo.php',
            'video' => 'post-video.php',
            'text' => 'post-text.php',
            'quote' => 'post-quote.php',
        ];
        $postSnippet = $postSnippets[$postType] ?? 'post-unknown.php';
        include __DIR__ . '/' . $postSnippet;

        echo '</div>';
    } ?>
</div>
