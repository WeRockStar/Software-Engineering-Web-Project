<?php

session_start();

$id = isset($_GET['id']) ? $_GET['id'] : "";
$type = isset($_GET['type']) ? $_GET['type'] : "";
$ticket = isset($_GET['ticket']) ? $_GET['ticket'] : "";
$quantity = 1;

if(!isset($_SESSION['cart_items'])){
    $_SESSION['cart_items'] = array();
	$_SESSION['type_items'] = array();
	$_SESSION['ticket_id'] = array();
}

if(array_key_exists($id, $_SESSION['cart_items'])){
	header('Location: detail_tournaments.php?tournament_id=' . $id . '&type=member');
}

else{
    $_SESSION['cart_items'][$id]=$quantity;
	$_SESSION['type_items'][$id]=$type;
	$_SESSION['ticket_id'][$id]=$ticket;
 
    // redirect to product list and tell the user it was added to cart
    header('Location: buy.php');
}

?>