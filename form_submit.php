<?php
require_once 'classes/Comment.php';
if (isset($_POST['author']) && isset($_POST['comment']) && isset($_POST['post_id'])){
  $author = htmlentities($_POST['author']);
  $comment_text = htmlentities($_POST['comment']);
  $post_id = intval($_POST['post_id']);
  $comment = new Comment();
  $comment->set('author', $author);
  $comment->set('comment_text', $comment_text);
  $comment->set('post_id', $post_id);
  $comment->set('ip', $_SERVER['REMOTE_ADDR']);
  $result = $comment->save();
  if ($result) {
    echo 'Комментарий добавлен!';
  } else {
    echo 'Комментарий не был добавлен!';
  }
}

