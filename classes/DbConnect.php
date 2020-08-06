<?php

class DbConnect extends PDO {
    private $dbhost     = 'localhost';
    private $dbuser     = 'root';
    private $dbpassword = '';
    private $dbname     = 'blog';

    public function __construct() {
        try {
            // since you are extending PDO, you have to call its constructor
            parent::connect(":host=$this->dbhost; dbname=$this->dbname", $this->dbuser, $this->dbpassword);
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
