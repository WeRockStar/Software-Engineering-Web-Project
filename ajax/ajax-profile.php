<?php

include_once '../config/config.php';

class Update extends dbConnection {

    public function __construct() {
        parent::__construct();
    }

}

$passC = $_POST['passC'];
$password = $_POST['password'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$bday = $_POST['bday'];
$address = $_POST['address'];
$tel = $_POST['tel'];
$id = $_POST['id'];
if($passC == $password){
$db = new Update();
$sql = "update user set firstname = '" . $fname . "' , lastname = '" . $lname . "' , email = '" . $email . "' , birthday = '" . $bday . "' , address = '" . $address . "' , phone = '" . $tel . "' where user_id = '" . $id. "'";
$rs = mysqli_query($db->getLink(), $sql);
if($rs){
    echo "success";
}  else {
    echo "error";    
}
}else echo "error";
?>