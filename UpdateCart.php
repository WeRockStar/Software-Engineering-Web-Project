<?php

session_start();

$id = isset($_GET['id']) ? $_GET['id'] : "";
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "";

$_SESSION['cart_items'][$id]=$quantity;

header('Location: buy.php');

?>