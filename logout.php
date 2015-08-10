<?php

session_start();
session_destroy(); //delete sesssion
header("location: index.php");
?>