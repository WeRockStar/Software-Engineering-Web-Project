<?php
include_once '../config/config.php';
$name = $_POST['t-name'];
$date = $_POST['t-date'];
$time = $_POST['t-time'];
$location = $_POST['t-location'];
$detail = $_POST['t-detail'];
$img = $_POST['t-img'];
$front = $_POST['t-front'];
$mid = $_POST['t-mid'];
$rear = $_POST['t-rear'];

$sql = "insert into tournament(tournament_name, tournament_start, tournament_location, tournament_time, tournament_detail, tournament_img, front_price, mid_price, rear_price) 
values ('$name' , '$date' , '$location' , '$time', '$detail', '$img', '$front', '$mid', '$rear')";
$db = new dbConnection();
$rs = mysqli_query($db->getLink(), $sql);
if ($rs) {
    echo "success";
} else {
    echo "error";
}
?>
