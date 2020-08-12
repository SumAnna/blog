<?php

class DbConnect extends PDO {

    public function __construct() {
        try {
            parent::__construct('mysql:host=localhost;dbname=blog', 'blog', 'blog');
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

