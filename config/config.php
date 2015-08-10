<?php

class dbConnection {

    private $host;
    private $user;
    private $pass;
    private $dbname;
    private $link, $rs;

    public function __construct() {
        $this->host = "localhost";
        $this->user = "root";
        $this->pass = "";
        $this->dbname = "group43";
        try {
            $this->link = @mysqli_connect($this->host, $this->user, $this->pass, $this->dbname) or die(mysqli_connect_error());
            mysqli_set_charset($this->link, "utf8");
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function insert($sql) {
        $this->rs = mysqli_query($this->link, $sql);
        if ($this->rs) {
            return "success";
        } else {
            return "error";
        }
    }

    public function getHost() {
        return $this->host;
    }

    public function getPassword() {
        return $this->pass;
    }

    public function getDB() {
        return $this->dbname;
    }

    public function getLink() {
        return $this->link;
    }

    public function getUser() {
        return $this->user;
    }

}

?>
