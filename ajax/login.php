<?php

include_once '../config/config.php';
$user = ($_POST['username-login']);
$pass = ($_POST['password-login']);
session_start();

if ($_POST) {

    class Login extends dbConnection {

        public function __construct() {
            parent::__construct();
        }

        public function __destruct() {
            
        }

    }

    $db = new Login();
    $sql = "select *from user where username = '" . $user . "' AND password = '" . $pass . "'";
    $rs = mysqli_query($db->getLink(), $sql);
    try {
        if (mysqli_num_rows($rs) != 0) {
            $name = "" ;
            $type = "";
            $id = "";
            while ($row = mysqli_fetch_array($rs)) {
                $name = $row['firstname'] . " " . $row['lastname'];
                $type = $row['type'];
                $id = $row['user_id'];
            }
            $_SESSION['user'] = $name;
            $_SESSION['type'] = $type;
            $_SESSION['id'] = $id;
            echo "success";
        } else {
            echo "error";
        }
    } catch (Exception $exc) {
        echo $exc->getMessage();
    }
}
?>