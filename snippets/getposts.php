<?php
$tumblr_url = "https://api.tumblr.com/v2/blog/" .
    option('mirthe.mytumblr.domain') .
    "/posts?api_key=" . option('mirthe.mytumblr.apiKey') .
    "&limit=" . option('mirthe.mytumblr.limit') .
    "&attach_reblog_tree=false";

$cache = kirby()->cache('mirthe.mytumblr');
$cacheKey = 'tumblr-posts-' . strtolower(option('mirthe.mytumblr.domain'));
$feed = $cache->get($cacheKey);
$force = isset($_GET['forcecache']);

if ($feed === null || $force) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $tumblr_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, kirby()->site()->title());

    $feed = curl_exec($ch);
    $error = curl_errno($ch);
    curl_close($ch);

    if ($feed !== false && $error === 0) {
        $cache->set($cacheKey, $feed, 2 * 3600);
    } else {
        $feed = $cache->get($cacheKey);
    }
}

$apidata = json_decode($feed);
$mypostsdata = $apidata->response->posts;
