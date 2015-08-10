<?php

include './config/config.php';

class GetRating extends dbConnection {

    public function __construct() {
        parent::__construct();
    }

}

$get = new GetRating();
$text = strip_tags($_GET['rating']);
$seller = strip_tags($_GET['seller']);
$user = strip_tags($_GET['user']);

if ($text != "" && $seller != "" && $user != "") {
    $sql = "select *from rating where seller_id ='" . $seller . "' and user_id='" . $user . "'";
    $rs = mysqli_query($get->getLink(), $sql);

    if (mysqli_num_rows($rs) >= 1) {
        $update = "update rating set value=$text where user_id=$user";
        $ru = mysqli_query($get->getLink(), $update);
        try {
            echo 'success u';
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    } else {
        $sqlInsert = "insert into rating values('" . $seller . "' ,'" . $user . "' , '" . $text . "')";
        $result = mysqli_query($get->getLink(), $sqlInsert);
        try {
            echo 'success i';
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
}
?>
