<?php
require_once "inc/header.php";
require_once "app/classes/Order.php";
require_once "app/classes/Cart.php";
require_once "app/classes/User.php";

$user = new User();
if (!$user->is_loggedIn()){
    header("Location: login.php");
    exit();
}


$order = new Order();
$orders = $order->get_orders();
?>


<table class="table">
    <thead>
    <tr>
        <th scope="col">Broj narudžbe</th>
        <th scope="col">Adresa isporuke</th>
        <th scope="col">Datum</th>
        <th scope="col">Proizvod</th>
        <th scope="col">Cijena</th>
        <th scope="col">Veličina</th>
        <th scope="col">Količina</th>
        <th scope="col">Slika</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($orders as $order) : ?>
        <tr>
            <td><?php echo $order['order_id']; ?></td>
            <td><?php echo $order['delivery_address']; ?></td>
            <td><?php echo $order['created_at']; ?></td>
            <td><?php echo $order['name']; ?></td>
            <td><?php echo $order['price']; ?></td>
            <td><?php echo $order['size']; ?></td>
            <td><?php echo $order['quantity']; ?></td>
            <td><img src="public/images/<?php echo $order['image']; ?>" alt="Product Image" style="height: 50px;"></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>







<?php require_once "inc/footer.php"; ?>
