<?php
$id = $_GET['id'];
include_once './config/config.php';
$db = new dbConnection();
$sql = "delete from user where user_id = '".$id."'";
$rs = mysqli_query($db->getLink(), $sql);
if($rs){
    header("location: admin-user.php");
}
?>