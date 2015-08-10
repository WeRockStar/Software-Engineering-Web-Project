<?php
$id = $_POST['userid'];
$username = $_POST['username'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$birthday = $_POST['birthday'];
$status = $_POST['status'];
$password = $_POST['password'];

include_once '../config/config.php';
$db = new dbConnection();
$sql = "update user set user_id = '".$id."' , username = '".$username."' , password = '".$password."' , type = '".$status."' , firstname = '".$fname."'";
$sql .= ", lastname = '".$lname."' , email = '".$email."' , birthday = '".$birthday."' , address = '".$address."' , phone = '".$phone."' where user_id = '".$id."'";
$rs = mysqli_query($db->getLink(), $sql);
if($rs){
    echo "success";
}else{
    echo "error";
}
?>