<?php
$pageTitle = "Detalji Narudžbe";
require_once 'inc/header.php';
require_once '../app/classes/Order.php';
require_once '../app/classes/User.php';
require_once '../app/classes/Product.php';
require_once '../app/classes/Utils.php';

$user = new User();
if (!$user->is_admin($_SESSION['user_id'])) {
    header("Location: ../index.php");
}

$order = new Order();
$utils = new Utils();

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $order_details = $order->get_order_details($order_id);
}
$thisOrder=$order->getOrder($order_id);
$user = $user->getUser($thisOrder['user_id']);

?>

<div class="container mt-5">
    <?php
    function calculate_total_price(array $order_details)
    {
        $total_price = 0;
        foreach ($order_details as $item) {
            $total_price += $item['price'] * $item['quantity'];
        }
        return $total_price;
    }

    if (isset($order_details)) : ?>
        <h2 class="mb-4">Detalji Narudžbe #<?php echo $order_id; ?></h2>
        <p><strong>Korisnik:</strong> <?php echo $user['name']; ?></p>
        <p><strong>Datum:</strong> <?php echo $utils->format_date($thisOrder['created_at']); ?></p>
        <p><strong>Adresa dostave:</strong> <?php echo $thisOrder['delivery_address'] ?></p>
        <h4 class="mt-4">Stavke Narudžbe</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Proizvod</th>
                    <th>Cijena</th>
                    <th>Količina</th>
                    <th>Ukupno</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_details as $item) : ?>
                    <tr>
                        <td><?php echo $item['name']; ?></td>
                        <td>$<?php echo $item['price']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>$<?php echo $item['price']*$item['quantity']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h4 class="mt-3">Ukupna Cijena: €<?php echo calculate_total_price($order_details); ?></h4>

    <?php else : ?>
        <p>Nema dostupnih detalja za ovu narudžbu.</p>
    <?php endif; ?>
</div>

<?php require_once 'inc/footer.php'; ?>
