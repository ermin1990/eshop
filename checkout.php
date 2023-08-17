<?php

$pageTittle = " - Checkout";
require_once "inc/header.php";
require_once "app/classes/Order.php";
require_once "app/classes/User.php";

$user = new User();
if (!$user->is_loggedIn()){
    header("Location: login.php");
    exit();
}


if($_SERVER['REQUEST_METHOD']=="POST"){
    $order = new Order();
    $delivery_address = $_POST['country'].",".$_POST['city'].",".$_POST['zip'].",".$_POST['address'];
    $order = $order->createOrder($delivery_address);

    header("Location: orders.php");
    exit();

}


?>

<h3 class="mt-5 display-5">Unesite podatke za narudžbu!</h3>
    <form action="" method="POST" class="mt-3">
        <div class="mb-3">
            <label for="country" class="form-label">Država</label>
            <input type="text" class="form-control" id="country" name="country" required>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">Grad</label>
            <input type="text" class="form-control" id="city" name="city" required>
        </div>
        <div class="mb-3">
            <label for="zip" class="form-label">ZIP</label>
            <input type="text" class="form-control" id="zip" name="zip" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Adresa</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <button type="submit" class="btn btn-primary">Naruči</button>
    </form>







<?php
require_once("inc/footer.php");