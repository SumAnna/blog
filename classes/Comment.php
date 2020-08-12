<?php
require_once('DbConnect.php');
//Класс комментариев
//Читает записи комментариев
class Comment
{
  private $id;
  private $author;
  private $comment_text;
  private $created_at;
  private $post_id;
  private $ip;
  private static $tablename = 'comment';
  // Конструктор
    public function __construct($id = null)
    {
        if ($id) {
            $link = new DbConnect();
            $sql = $link->prepare('SELECT id, post_id, author, comment_text, ip, created_at FROM ? WHERE id=?');
            $sql->execute([self::$tablename, $id]);
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            $this->id = $result['id'];
            $this->author = $result['author'];
            $this->comment_text = $result['comment_text'];
            $this->post_id = $result['post_id'];
            $this->ip = $result['ip'];
            $this->created_at = $result['created_at'];
            return $result;
        }
        else {
            $this->created_at = date('Y-m-d H:i:s');
            return false;
        }
    }
    
    public function save(){
      if ($this->id) {
        return false;
      }
      $link = new DbConnect();
      $sql = $link->prepare('INSERT INTO '.self::$tablename.' (id, post_id, author, comment_text, ip, created_at) VALUES (NULL, ?, ?, ?, ?, ?)');
      $sql->bindParam(1, $this->post_id, PDO::PARAM_INT);
      $sql->bindParam(2, $this->author, PDO::PARAM_STR, 64);
      $sql->bindParam(3, $this->comment_text, PDO::PARAM_STR);
      $sql->bindParam(4, $this->ip, PDO::PARAM_STR, 15);
      $sql->bindParam(5, $this->created_at, PDO::PARAM_STR);
      return $sql->execute();
    }
    
    public function __set($param, $value){
      if(empty($param) || empty($value)) {
        return false;
      }
      $this->$param = $value;
      return true;
    }
    public function __get($attr){
      if(empty($attr)) {
        return false;
      }
      return  $this->$attr;
    }
}
