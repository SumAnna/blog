<?php

class DbConnect extends PDO {
    private $dbhost     = 'localhost';
    private $dbuser     = 'blog';
    private $dbpassword = 'blog';
    private $dbname     = 'blog';
    private $dbtype     = 'mysql';    

    public function __construct() {
        try {
            $param = "$this->dbtype:host=$this->dbhost;dbname=$this->dbname";
            parent::__construct("$this->dbtype:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpassword);
            //$this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
