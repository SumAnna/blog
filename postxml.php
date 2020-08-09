<?php
require_once 'classes/Post.php';
require_once 'classes/Comment.php';
if (isset($_GET['id'])){
  $id = intval($_GET['id']);
  $post = new Post($id);
//var_dump($post->getPostXML()->saveXML());
  echo "<!doctype html><html><head></head><body><textarea rows='100' cols='160'>". $post->getPostDOM()->saveXML() ."</textarea></body></html>";
} else {
  echo '404';
}


