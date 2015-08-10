<?php

require_once './config/config.php';

class SignUp {
    public $callback = "";
    public function SignUpUser() {

        $user = addslashes(trim($_POST['username']));
        $psw = addslashes(trim($_POST['password']));
        $fname = addslashes(trim($_POST['fname']));
        $lname = addslashes(trim($_POST['lname']));
        $email = addslashes(trim($_POST['email']));
        $sex = addslashes(trim($_POST['sex']));
        $birthday = addslashes(trim($_POST['birthday']));
        $phone = addslashes(trim($_POST['phone']));
        $name = addslashes(trim($_POST['nameshow']));
        $address = addslashes(trim($_POST['address']));
        $district = addslashes(trim($_POST['district']));
        $province = addslashes(trim($_POST['province']));
        $postcode = addslashes(trim($_POST['postcode']));

        $sql = "INSERT INTO member ";
        $sql .= " VALUES(0, '$user' , '$psw' , '$fname' , '$lname' , '$email' , '$sex' , '$birthday' , '$phone')";

        $db = new dbConnection();
        $this->callback = $db->insert($sql);
    }

}

$signup = new SignUp();
$signup->SignUpUser();
echo $signup->callback;
?>