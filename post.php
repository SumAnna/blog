<?php
require_once 'classes/Post.php';
require_once 'classes/Comment.php';
if (isset($_GET['id'])){
  $id = intval($_GET['id']);
  $post = new Post($id);
//var_dump($post->getPostXML()->saveXML());
  //echo "<!doctype html><html><head></head><body><textarea rows='100' cols='160'>". $post->getPostDOM()->saveXML() ."</textarea></body></html>";
  $xslt = new XSLTProcessor();
  $doc = new DOMDocument();
  $doc->load('post.xsl');

  $xslt->importStyleSheet($doc);

  echo $xslt->transformToXML($post->getPostDOM());
} else {
  echo '404';
}


