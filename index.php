<?php
require_once __DIR__.'/classes/Post.php';
$page = isset($_GET["page"]) ?  $_GET["page"] : 1;
$posts = Post::getDOM($page);
if ($page < 1 || $page > Post::getPagesCount()) {
    header('Location: /errors/404.html');
    exit;
}
$xslt = new XSLTProcessor();
$doc = new DOMDocument();
$doc->load(__DIR__.'/templates/posts.xsl');
$xslt->importStyleSheet($doc);
echo $xslt->transformToXML($posts);
