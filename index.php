<?php
require_once 'classes/Post.php';

//$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);

$page = isset($_GET["page"]) ?  $_GET["page"] : 1;
//$postsperpage = Post::getDom($page);

if ($page < 1 || $page > Post::getPagesCount()) {
    header('Location: /errors/404.html');
    exit;
}

$posts = Post::getDOM($page);
$pages = Post::getPagesCount();
$xslt = new XSLTProcessor();
$doc = new DOMDocument();
$doc->load('templates/posts.xsl');

$xslt->importStyleSheet($doc);

//echo $xslt->transformToXML($posts);

echo str_replace("&lt;br /&gt;","<br />",$xslt->transformToXML($posts));
