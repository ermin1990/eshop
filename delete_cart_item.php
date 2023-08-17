<?php
require_once('app/config/config.php');
require_once('app/classes/Cart.php');

$cart_item_id = $_GET['id'];
$cart = new Cart();

$cart->delete_cart_item($cart_item_id);

header("Location: cart.php");
