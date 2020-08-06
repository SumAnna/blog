
<?php
require_once('DBConnect.php');
//Класс статей
//Читает записи статей
class Articles
{
  private $id;
  private $title;
  private $content;
  private $create_date;
  private $tablename = 'articles';
  // Конструктор
    public function __construct($id = null)
    {
        if($id)
        {
            $link = db_connect();
            $sql = $link->prepare('SELECT * FROM ? WHERE id=?');
            $sql->execute([$this->tablename, $id]);
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            $this->id = $result['id'];
            $this->title = $result['title'];
            $this->content = $result['content'];
            $this->create_date = $result['date'];
            //$this->comments = $this->comments();
            return $result;
        }
        else {
            $this->create_date = date('Y-m-d');
            return false;
        }
    }
}
?>