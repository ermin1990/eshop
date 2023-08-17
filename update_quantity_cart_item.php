<?php
require_once('app/config/config.php');
require_once('app/classes/Cart.php');

$cart = new Cart();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $cart_id = $_GET['id'];
    $quantity = $_POST['quantity'];


    $update = $cart->update_quantity_cart_item($cart_id, $quantity);
    if ($update){
        return true;
    }
    return $cart_id;
}


