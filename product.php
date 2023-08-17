<?php
$pageTittle = "- Product";
require_once("inc/header.php");
require_once("app/classes/Product.php");
require_once "app/classes/Cart.php";


$user = new User();

$product = new Product();
$product = $product->get_one_product($_GET['id']);

if ($_SERVER['REQUEST_METHOD']== "POST"){
    $product_id = $product['product_id'];
    $user_id = $_SESSION['user_id'];
    $quantity = $_POST['quantity'];

    $cart = new Cart();
    $cart->add_to_cart($product_id,$user_id,$quantity);

    header("Location: cart.php");
    exit();

}




?>

<div class="container mt-3">
    <?php if (!$user->is_loggedIn()):?>
        <div class="bg-danger text-white alert">Morate biti ulogovani da biste dodali proizvod u korpu </br><a class="text-decoration-none text-white text-bold" href="login.php">Uloguj se!</a>
                    </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-6">
            <img src="public/images/<?php echo $product['image']; ?>" class="img-fluid" alt="Product Image">
        </div>
        <div class="col-md-6">
            <h2 class="display-4"><?php echo $product['name'];?></h2>
            <p class="">Price: €<?php echo $product['price']; ?></p>
            <p>Size: <?php echo $product['size']; ?></p>
            <form action="" method="post">
                <label for="">Količina</label>
                <input class="productForm_quantity_input" type="number" value=1 name="quantity" placeholder="1" min="1"><br>
                <button type="submit" class="btn btn-primary <?php if (!$user->is_loggedIn()){echo "disabled";} ?> mt-4">Add to Cart</button>
                <br>

            </form>

        </div>
    </div>
</div>

<?php
require_once("inc/footer.php");
