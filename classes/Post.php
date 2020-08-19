<?php
require_once(__DIR__.'/DbConnect.php');

//Класс постов
//Читает записи постов
class Post {
  private $id;
  private $title;
  private $content;
  private $created_at;
  private $comments = [];
  private static $tablename = 'post';
  private static $commenttable = 'comment';
  private static $postcount = 10;
  private static $pages;
  private static $allPosts;
  
  
// Конструктор
  public function __construct($id = null) {
    $result = false;
    $link = self::setLink();
    if (intval($id)) {
      $sql = $link->prepare('SELECT post.id, post.title, post.content, post.created_at, comment.id AS cid, comment.author, comment.comment_text, comment.ip, comment.created_at AS c_created_at FROM '.self::$tablename.' LEFT JOIN '.self::$commenttable.' ON post.id=comment.post_id WHERE post.id=? ORDER BY post.created_at, comment.created_at DESC');
      $sql->execute([intval($id)]);
      $flag = true;
      while($result = $sql->fetch(PDO::FETCH_ASSOC)) {
        if ($result) {
          if ($flag) {
            $this->id = $id;
            $this->title = $result['title'];
            $this->content = $result['content'];
            $this->created_at = $result['created_at'];
            $flag = false;
          }
          if ($result['cid']) {
            $cid = $result['cid'];
            $this->comments[$cid]['id'] = $cid;
            $this->comments[$cid]['author'] = $result['author'];
            $this->comments[$cid]['comment_text'] = $result['comment_text'];
            $this->comments[$cid]['ip'] = $result['ip'];
            $this->comments[$cid]['created_at'] = $result['c_created_at'];
          }
        }
      }
    }
  }

  public static function setLink() {
    if (empty(self::$link)) {
      self:$link = new DbConnect();
    }
    return $link;
  }

  public static function getPosts($page) {
    if ($page < 0) {
      return false;
    }
    $link = self::setLink();
    $startid = ($page - 1) * self::$postcount;
    $sql = $link->prepare('SELECT SQL_CALC_FOUND_ROWS '.self::$tablename.'.id, '.self::$tablename.'.title, '.self::$tablename.'.content, '.self::$tablename.'.created_at, COUNT('.self::$commenttable.'.id) AS count FROM '.self::$tablename.' LEFT JOIN '.self::$commenttable.' ON '.self::$tablename.'.id='.self::$commenttable.'.post_id GROUP BY '.self::$tablename.'.id ORDER BY '.self::$tablename.'.created_at DESC LIMIT '.intval($startid).', '.intval(self::$postcount));
    $sql->execute();
    $sql_pages = $link->prepare('SELECT FOUND_ROWS() AS p_count');
    $sql_pages->execute();
    self::$allPosts = $sql_pages->fetch(PDO::FETCH_ASSOC)['p_count'];
    self::$pages = ceil(self::$allPosts / self::$postcount);
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  /*public function getComments() {
    $link = self::setLink();
    $sql = $link->prepare('SELECT id, author, comment_text, ip, created_at, post_id FROM '.self::$commenttable.' WHERE post_id = ? ORDER BY created_at DESC');
    $sql->execute([intval($this->id)]);
    $sql_assoc = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $sql_assoc;
  }*/

  public static function getDOM($page = 1) {
    $dom = new DOMDocument('1.0', 'UTF-8');
    $posts = self::getPosts($page);
    $root = $dom->createElement('blog');
    $root->setAttribute('id', 'posts');
    $root->setAttribute('page', isset($_GET['page']) ?  $_GET['page'] : 1); 
    $root->setAttribute('pages_count', self::$pages);
    $dom->appendChild($root);
    if ($posts) {
      foreach($posts as $post) {
        $element = $dom->createElement('post');
        $element->setAttribute('id', $post['id']);
        $element->setAttribute('title', $post['title']);
        $element->setAttribute('content', nl2br(htmlspecialchars($post['content'])));
        $element->setAttribute('created_at', $post['created_at']);
        $element->setAttribute('comments', $post['count']);
        $root->appendChild($element);
      }
    }
    return $dom;
  }
  
  public function getPostDOM() {
    $dom = new DOMDocument('1.0', 'UTF-8');
    $root = $dom->createElement('post');
    $root->setAttribute('id', $this->id);
    $root->setAttribute('title', $this->title);
    $root->setAttribute('content', nl2br(htmlspecialchars($this->content)));
    $root->setAttribute('created_at', $this->created_at);
    $dom->appendChild($root);
    //$comments = $this->getComments($this->id);
    if ($this->comments) {
      foreach($this->comments as $comment) {
        $element = $dom->createElement('comment');
        $element->setAttribute('id', $comment['id']);
        $element->setAttribute('author', $comment['author']);
        $element->setAttribute('comment', nl2br(htmlspecialchars($comment['comment_text'])));
        $element->setAttribute('ip', $comment['ip']);
        $element->setAttribute('created_at', $comment['created_at']);
        $root->appendChild($element);
      }
    }
    return $dom;
  }

  public function get($attr) {
    if (empty($attr)) {
      return false;
    }
    return  $this->$attr;
  }

  public static function validate($id) {
    $link = self::setLink();
    $sth = $link->prepare('SELECT id FROM post WHERE id = ? LIMIT 1');
    $sth->execute([$id]);
    $result = $sth->fetch();
    if ($result) {
      $validated = true;
    } else {
      $validated = false;
    }
    return $validated;
  }
  
  public static function getPagesCount() {
    $p_count = self::$pages;
    return $p_count;
  }
  
}