<?php
$pageTittle = " - Cart";
require_once "inc/header.php";
require_once "app/classes/Cart.php";
require_once "app/classes/User.php";

$user = new User();
if (!$user->is_loggedIn()){
    header("Location: login.php");
    exit();
}


$cart = new Cart();
$cart_items = $cart->get_cart_items();


?>
<script src="https://unpkg.com/htmx.org@1.9.4"></script>
<h3 class="display-3">Moja korpa</h3>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Proizvod</th>
        <th scope="col">Veličina</th>
        <th scope="col">Cijena po komadu</th>
        <th scope="col">Količina</th>
        <th scope="col">Ukupna cijena</th>
        <th scope="col">Slika</th>
        <th scope="col">Akcije</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($cart_items as $index => $item) : ?>
        <tr>
            <th scope="row"><?php echo $index + 1; ?></th>
            <td><?php echo $item['name']; ?></td>
            <td><?php echo $item['size']; ?></td>
            <td>€<?php echo $item['price']; ?></td>
            <td><input value="<?php echo $item['quantity']; ?>" name="quantity"  type="text"
                       hx-post="update_quantity_cart_item.php?id=<?php echo $item['cart_id'];?>"
                       hx-trigger="keyup delay:1s"
                       hx-swap-oob="true"
                       hx-on:htmx:after-swap="location.reload();"
                ></td>
            <td>€<?php echo $item['price'] * $item['quantity']; ?></td>
            <td><img src="public/images/<?php echo $item['image']; ?>" alt="Product Image" style="height: 50px;"></td>
            <td><a href="delete_cart_item.php?id=<?php echo $item['cart_id'] ?>" class="btn btn-danger btn-sm">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="mt-3">
    <p class="fw-bold">Ukupna cijena: €
        <?php
        $total_price = 0;
        foreach ($cart_items as $item) {
            $total_price += $item['price'] * $item['quantity'];
        }
        echo $total_price;
        ?>
    </p>
    <a href="checkout.php" class="btn btn-primary">Checkout</a>
</div>


<?php require_once "inc/footer.php" ?>
