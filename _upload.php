
<?php

$link = mysqli_connect("localhost", "group43", "@qtym8P#$", "group43") or die(mysqli_connect_error());
//file property
$file = $_FILES['image']['tmp_name'];
if (!isset($file)) {
    echo "please select an image";
} else {
    //echo file_get_contents($_FILES['image']['tmp_name']);
    $image = $_FILES['image']['tmp_name']; //temp path
    $image_name = $_FILES['image']['name']; //name
    $image_size = getimagesize($_FILES['image']['tmp_name']);
    
    if($image_size == FALSE){
        echo "That not an image";
    }else{
        $insert = mysqli_query($link,"INSERT INTO images VALUES('' , '$image')");
        if($insert){
            $lastid = mysqli_insert_id($link);
             echo "<br><a href='get.php?id=$lastid'>Click</a>";
             echo "Image uplaoded.<br>Your image.<img src='get.php?id=".$lastid."'>";
             
        }else{
            
           
        }
            
    }
}
$sql = "";
?>