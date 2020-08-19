<?php
require_once __DIR__.'/classes/Post.php';
require_once __DIR__.'/classes/Comment.php';
if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $post = new Post($id);
  if (empty($post->get('id'))) {
    header('Location: /errors/404.html');
    exit;
  }
  $xslt = new XSLTProcessor();
  $doc = new DOMDocument();
  $doc->load(__DIR__.'/templates/post.xsl');
  $xslt->importStyleSheet($doc);
  echo $xslt->transformToXML($post->getPostDOM());
} else {
    header('Location: /errors/404.html');
    exit;
}


