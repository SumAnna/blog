<?php

class DbConnect extends PDO {

    public function __construct() {
        try {
            parent::__construct('mysql:host=localhost;dbname=blog', 'blog', 'blog');
            $sql = $this->prepare('SET NAMES utf8');
            $sql->execute();
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

