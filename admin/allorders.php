<?php
$pageTitle = "Sve Narudžbe";
require_once 'inc/header.php';
require_once '../app/classes/Cart.php';
require_once '../app/classes/Order.php';
require_once '../app/classes/User.php';
require_once '../app/classes/Product.php';

require_once '../app/classes/Utils.php';

$user = new User();
if (!$user->is_admin()) {
    header("Location: ../index.php");
}

$order = new Order();
$orders = $order->get_all_orders();


$product = new Product();
$utils = new Utils();

?>

<div class="container mt-5">
    <h2 class="mb-4">Sve Narudžbe</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Narudžba ID</th>
            <th>Korisnik</th>
            <th>Datum</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $or) : ?>
            <tr>
                <td><?php echo $or['order_id']; ?></td>
                <td><?php echo $or['name']; ?></td>
                <td><?php echo $utils->format_date($or['created_at']); ?></td>
                <td>
                    <a href="order_details.php?order_id=<?php echo $or['order_id']; ?>" class="btn btn-primary">Detalji</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

