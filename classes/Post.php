<?php
require_once('DbConnect.php');
//Класс постов
//Читает записи постов
class Post
{
  private $id;
  private $title;
  private $content;
  private $created_at;
  private $comments = [];
  private static $tablename = 'post';
  private static $commenttable = 'comment';
  private static $postcount = 10;
  // Конструктор
    public function __construct($id = null)
    {
      $result = false;
        if ($id) {
            $link = new DbConnect();
            $sql = $link->prepare('SELECT id, title, content, created_at FROM '.self::$tablename.' WHERE id=?');
            $sql->execute([$id]);
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            if ($result) {
              $this->id = $result['id'];
              $this->title = $result['title'];
              $this->content = $result['content'];
              $this->created_at = $result['created_at'];
              $result = $this;
              $this->comments = $this->getComments($id);
            }
        }
        else {
            $this->created_at = date('Y-m-d H:i:s');
        }
        return $result;
    }
    
    public static function getPosts($page){
      $link = new DbConnect();
      if ($page < 0){
        return false;
      }
      $startid = ($page - 1) * self::$postcount;
      $sql = $link->prepare('SELECT id, title, content, created_at FROM '.self::$tablename.' ORDER BY created_at DESC LIMIT '.intval($startid).', '.intval(self::$postcount));
      $sql->execute();     
      return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function getPagesCount(){
      $link = new DbConnect();
      $sql = $link->prepare('SELECT COUNT(*) FROM '.self::$tablename);
      $sql->execute(); 
      $rows_count = $sql->fetch(PDO::FETCH_NUM);
      $pages_count = ceil($rows_count[0] / 10);
      return $pages_count;
    }
    
    public static function getCommentsCount($post_id){
      $link = new DbConnect();
      $sql = $link->prepare('SELECT COUNT(*) FROM '.self::$commenttable.' WHERE post_id = ?');
      $sql->execute([intval($post_id)]);
      $array = $sql->fetch(PDO::FETCH_ASSOC);
      return $array['COUNT(*)'];
    }
        
    public function getComments(){
      $link = new DbConnect();
      $sql = $link->prepare('SELECT id, author, comment_text, ip, created_at, post_id FROM '.self::$commenttable.' WHERE post_id = ? ORDER BY created_at DESC');
      $sql->execute([intval($this->id)]);
      //var_dump($sql);      
      return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getDOM($page = 1){
      $dom = new DOMDocument('4.0', 'UTF-8');
      $root = $dom->createElement('blog');
      $id = $dom->createAttribute('id');
      $id->value = 'posts';
      $root->appendChild($id);
      $current = $dom->createAttribute('page');
      $current->value = isset($_GET['page']) ?  $_GET['page'] : 1;
      $root->appendChild($current);
      $pages_count = $dom->createAttribute('pages_count');
      $pages_count->value = self::getPagesCount();
      $root->appendChild($pages_count);
      $dom->appendChild($root);
      $posts = self::getPosts($page);
      if ($posts){
        foreach($posts as $post){
          $element = $dom->createElement('post');
          $element_id = $dom->createAttribute('id');
          $element_id->value = $post['id'];
          $element->appendChild($element_id);
          $element_title = $dom->createAttribute('title');
          $element_title->value = $post['title'];
          $element->appendChild($element_title);
          $element_content = $dom->createAttribute('content');
          $element_content->value = $post['content'];
          $element->appendChild($element_content);
          $element_created_at = $dom->createAttribute('created_at');
          $element_created_at->value = $post['created_at'];
          $element->appendChild($element_created_at);
          $element_comments = $dom->createAttribute('comments');
          $element_comments->value = self::getCommentsCount($post['id']);
          $element->appendChild($element_comments);
          $root->appendChild($element);
        }
      }
      
      return $dom;
    }
    
    public function getPostDOM(){
      $dom = new DOMDocument('4.0', 'UTF-8');
      $root = $dom->createElement('post');
      $id = $dom->createAttribute('id');
      $id->value = $this->id;
      $root->appendChild($id);
      $title = $dom->createAttribute('title');
      $title->value = $this->title;
      $root->appendChild($title);
      $content = $dom->createAttribute('content');
      $content->value = $this->content;
      $root->appendChild($content);
      $created_at = $dom->createAttribute('created_at');
      $created_at->value = $this->created_at;
      $root->appendChild($created_at);
      $dom->appendChild($root);
      $comments = $this->getComments($this->id);
      if ($comments){
        foreach($comments as $comment){
          $element = $dom->createElement('comment');
          $element_id = $dom->createAttribute('id');
          $element_id->value = $comment['id'];
          $element->appendChild($element_id);
          $element_author = $dom->createAttribute('author');
          $element_author->value = $comment['author'];
          $element->appendChild($element_author);
          $element_comment = $dom->createAttribute('comment');
          $element_comment->value = $comment['comment_text'];
          $element->appendChild($element_comment);
          $element_ip = $dom->createAttribute('ip');
          $element_ip->value = $comment['ip'];
          $element->appendChild($element_ip);
          $element_date = $dom->createAttribute('created_at');
          $element_date->value = $comment['created_at'];
          $element->appendChild($element_date);
          $root->appendChild($element);
        }
      }
      return $dom;
    }
}
