<?php $localfile =  __DIR__ . "/tumblr.json";
$tumblr_url = "https://api.tumblr.com/v2/blog/". 
    option('mirthe.mytumblr.domain') . 
    "/posts?api_key=". option('mirthe.mytumblr.apiKey') .
    "&limit=". option('mirthe.mytumblr.limit') .
    "&attach_reblog_tree=false";

if (!file_exists($localfile) OR time()-filemtime($localfile) > 2 * 3600 OR isset($_GET['forcecache'])) {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $tumblr_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $feed = curl_exec($ch);
    curl_close($ch);

    $fp = fopen($localfile, 'w');
    fwrite($fp, $feed);
    fclose($fp);

    // TODO cache forceren

} else {
    $feed = file_get_contents($localfile); 
} 

$apidata = json_decode($feed);
$mypostsdata = $apidata->response->posts; ?>