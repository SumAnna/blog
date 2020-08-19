<?php
//Класс для подключения к БД
class DbConnect extends PDO {
  public $link;
  //Конструктор
  public function __construct() {
      try {
          $this->link = parent::__construct('mysql:host=localhost;dbname=blog', 'blog', 'blog', array(PDO::ATTR_PERSISTENT => true, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',));
      }
      catch (PDOException $e) {
        echo 'Соединение оборвалось: ' . $e->getMessage();
        exit;
      }
  }
}

