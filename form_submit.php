<?php
require_once __DIR__.'/classes/Comment.php';
if (isset($_POST['author']) && isset($_POST['comment']) && isset($_POST['post_id'])) {
  $author  = filter_input(INPUT_POST, 'author');
  $comment_text  = filter_input(INPUT_POST, 'comment');
  $post_id = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_NUMBER_INT);
  $comment = new Comment();
  $error_name = false;
  $array_attr = ['author', 'comment_text', 'post_id'];
  $array_val = [$author, $comment_text, $post_id];
  foreach($array_attr as $key => $attr) {
    $result = $comment->validate($attr, $array_val[$key]);
    (true === $result) ? $comment->set($attr, $array_val[$key]) : $error_name .= '<li>'.$result.'</li>';
  }
    if (!$error_name) {
      $comment->set('ip', $_SERVER['REMOTE_ADDR']);
      $save = $comment->save();
      $result = [
            'author' => nl2br(htmlspecialchars($author)),
            'comment' => nl2br(htmlspecialchars($comment_text)),
            'created_at' => $comment->get('created_at'),
            'ip' => $comment->get('ip'),
      ];        
    } else {
      $result = ['error_name' => $error_name];
    }   
    echo json_encode($result);
    $result = false;
}
