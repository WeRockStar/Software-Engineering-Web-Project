<?php
$id = $_POST['t-id'];
$name = $_POST['t-name'];
$time = $_POST['t-time'];
$date = $_POST['t-date'];
$location = $_POST['t-location'];
$detail = $_POST['t-detail'];
$front = $_POST['t-front'];
$mid = $_POST['t-mid'];
$rear = $_POST['t-rear'];

include_once '../config/config.php';
$db = new dbConnection();
$sql = "update tournament set tournament_name = '".$name."' , tournament_time = '".$time."' , tournament_start = '".$date."' , tournament_location = '".$location."', tournament_detail = '".$detail."', front_price = '".$front."', mid_price = '".$mid."', rear_price = '".$rear."' where tournament_id = '".$id."'";
$rs = mysqli_query($db->getLink(), $sql);
if($rs){
    echo "success";
}else{
    echo "error";
}
?>