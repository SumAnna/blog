<?php
require_once(__DIR__.'/DbConnect.php');
require_once(__DIR__.'/Post.php');

//Класс комментариев
//Читает записи комментариев
class Comment {
  private $id;
  private $author;
  private $comment_text;
  private $created_at;
  private $post_id;
  private $ip;
  private static $tablename = 'comment';
  
  // Конструктор
  public function __construct($id = null) {
      if ($id) {
          $link = new DbConnect();
          $sql = $link->prepare('SELECT id, post_id, author, comment_text, ip, created_at FROM ? WHERE id=?');
          $sql->execute([self::$tablename, intval($id)]);
          $result = $sql->fetch(PDO::FETCH_ASSOC);
          $this->id = $result['id'];
          $this->author = $result['author'];
          $this->comment_text = $result['comment_text'];
          $this->post_id = $result['post_id'];
          $this->ip = $result['ip'];
          $this->created_at = $result['created_at'];
      }
      else {
          $this->created_at = date('Y-m-d H:i:s');
      }
  }

  public function save() {
    if ($this->id) {
      return false;
    }
    $link = new DbConnect();
    $sql = $link->prepare('INSERT INTO '.self::$tablename.' (id, post_id, author, comment_text, ip, created_at) VALUES (NULL, ?, ?, ?, ?, ?)');
    $this->post_id = intval($this->post_id);
    $sql->bindParam(1, $this->post_id, PDO::PARAM_INT);
    $sql->bindParam(2, $this->author, PDO::PARAM_STR, 64);
    $sql->bindParam(3, $this->comment_text, PDO::PARAM_STR);
    $sql->bindParam(4, $this->ip, PDO::PARAM_STR, 15);
    $sql->bindParam(5, $this->created_at, PDO::PARAM_STR);
    return $sql->execute();
  }

  public function set($param, $value) {
    if (empty($param) || empty($value)) {
      return false;
    }
    $this->$param = $value;
    return true;
  }

  public function get($attr) {
    if (empty($attr)) {
      return false;
    }
    return  $this->$attr;
  }

  public function validate($attr, $value) {
    switch ($attr) {
      case 'author':
        if (!$value) {
          $result = 'Введите имя';
        } else {
          if (strlen($value) > 0 && strlen($value) < 65) {
            $result = true;
          } else {
            $result = 'Превышение длины имени! Допускается от 1 до 64 символов';
          }
        }
        break;
      case 'comment_text':
        if (!$value) {
          $result = 'Введите текст комментария';
        } else {
          if (strlen($value) > 0 && strlen($value) < 65536) {
            $result = true;
          } else {
            $result = 'Превышение длины комментария! Допускается от 1 до 65535 символов';
          }
        }
        break;
      case 'post_id':
        if (Post::validate($value)) {
              $result = true;
          } else {
            $result = 'Пост не существует! Возможно, он был удален автором';
          }
        break;
      default :
         $result = false;
    }
    return $result;
  }
    
}
