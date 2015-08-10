<?php

include_once '../config/config.php';

class Update extends dbConnection {

    public function __construct() {
        parent::__construct();
    }

}

$username = $_POST['username'];
$password = $_POST['password'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$bday = $_POST['bday'];
$address = $_POST['address'];
$tel = $_POST['tel'];
$id = $_POST['id'];
$db = new Update();
$sql = "update user set username = '" . $username . "' , password = '" . $password . "' , firstname = '" . $fname . "' , lastname = '" . $lname . "' , email = '" . $email . "' , birthday = '" . $bday . "' , address = '" . $address . "' , phone = '" . $tel . "' where user_id = '" . $id. "'";
$rs = mysqli_query($db->getLink(), $sql);
if($rs){
    echo "success";
}  else {
    echo "error";    
}
?>