<?php
$id = $_GET['tournament_id'];
include_once './config/config.php';
$db = new dbConnection();
$sql = "delete from tournament where tournament_id = '".$id."'";
$rs = mysqli_query($db->getLink(), $sql);
if($rs){
    header("location: admin.php");
}
?>