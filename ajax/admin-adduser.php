<?php
include_once '../config/config.php';

class SignUp extends dbConnection {

    public $callback = "";

    public function __construct() {
        parent::__construct();
    }

    public function SignUpUser() {
        $user = addslashes(trim($_POST['username']));
        $psw = addslashes(trim($_POST['password']));
        $fname = addslashes(trim($_POST['fname']));
        $lname = addslashes(trim($_POST['lname']));
        $email = addslashes(trim($_POST['email']));
        $birthday = addslashes(trim($_POST['birthday']));
        $phone = addslashes(trim($_POST['phone']));
        $name = addslashes(trim($_POST['nameshow']));
        $address = addslashes(trim($_POST['address']));
        $district = addslashes(trim($_POST['district']));
        $province = addslashes(trim($_POST['province']));
        $status = $_POST['status'];

        $sqlProvince = "select PROVINCE_NAME from province where PROVINCE_ID = '" . $province . "'";
        $result = mysqli_query(parent::getLink(), $sqlProvince);
        $pro = "";
        while ($data = mysqli_fetch_array($result)) {
            $pro = $data['PROVINCE_NAME'];
        }

        $address .= " อ." . $district . " จ." . $pro;
        //$pattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{8,16}$/";
//        $pattern = "/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[0-9])\w{8,16}$/";
//        if (!preg_match($pattern, $psw)) {
//            echo "not match";
//            exit();
//        }
        $sql = "INSERT INTO user ";
        $sql .= " VALUES(0, '$user' , '$psw' , '$status' , '$fname' , '$lname' , '$email' , '$birthday' ,'$address','$phone');";
        $rs = mysqli_query(parent::getLink(), $sql);
        if ($rs) {
            echo "success";
            exit();
        } else {
            echo "error";
            exit();
        }
    }

}

$signup = new SignUp();
$signup->SignUpUser();
?>
