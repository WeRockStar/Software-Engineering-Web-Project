<?php
$province = "";
if ($_POST['id']) {
    $province = $_POST['id'];
} else {
    echo "error";
}
include_once '../config/config.php';
class GetDis extends dbConnection{
    public function __construct() {
        parent::__construct();
    }
}
$db = new GetDis();
$sql = "select AMPHUR_NAME from amphur where PROVINCE_ID = " . $province;
$rs = mysqli_query($db->getLink(), $sql);
while ($data = mysqli_fetch_array($rs)) {
    echo "<option>" . $data['AMPHUR_NAME'] . "</option>";
}
?>