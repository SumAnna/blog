<?php
require_once 'classes/Comment.php';
if (isset($_POST['author']) && isset($_POST['comment']) && isset($_POST['post_id'])){
  $author = $_POST['author'];
  $comment_text = $_POST['comment'];
  $post_id = $_POST['post_id'];
  $comment = new Comment();
  $comment->__set('author', $author);
  $comment->__set('comment_text', $comment_text);
  $comment->__set('post_id', $post_id);
  $comment->__set('ip', $_SERVER['REMOTE_ADDR']);
  $result = $comment->save();
  if ($result) {
    echo '{"message": "Комментарий добавлен", "ip": "'.$ip = $comment->__get('ip').'", "created_at": "'.$ip = $comment->__get('created_at').'"}';
  } else {
    echo '{"message": "Комментарий добавлен"}';
  }
}

