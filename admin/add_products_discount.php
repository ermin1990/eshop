<?php

$pageTittle = "- Akcije";
require_once 'inc/header.php';
require_once('../app/classes/Discount.php');
require_once('../app/classes/Product.php');
require_once('../app/classes/User.php');
require_once('../app/classes/Utils.php');

$products = new Product();
$all_products = $products->get_all();

$discount = new Discount();
$all_discounts = $discount->get_all_discounts();
$discount_id = $_GET['id'];
$utils = new Utils();
$user = new User();
if (!$user->is_admin($_SESSION['user_id'])) {
    header("Location: ../index.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $unchecked_products = isset($_POST['unchecked_products']) ? $_POST['unchecked_products'] : [];
    $selected_products = isset($_POST['selected_products']) ? $_POST['selected_products'] : [];


    // Dodajemo nove poveznice za odabrane proizvode
    $discount->add_product_to_discount($discount_id, $selected_products);


    // Uklanjamo poveznice za odabrane proizvode koji su skinuti

    $discount->remove_product_from_discount($selected_products, $discount_id);





    header("Location: discounts.php");
}

$thisDiscount = $discount->get_one_discount($discount_id);
?>

<form action="" method="post">
    <h3>Odaberi proizvode za:
        <!-- Prikaz informacija o akciji -->
        <?php echo $thisDiscount['name']; ?></h3>
    <p class="">Akcija traje u periodu: <?php echo $utils->format_date($thisDiscount['start_date']); ?> - <?php echo $utils->format_date($thisDiscount['end_date']); ?></p>

    <?php foreach ($all_products as $product) : ?>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="selected_products[]" value="<?php echo $product['product_id']; ?>"
                <?php if($discount->exist($product['product_id'],$discount_id)){echo 'checked';} ?>>
            <label class="form-check-label"><?php echo $product['name']; ?></label>

            <?php if(!$discount->exist($product['product_id'],$discount_id)): ?>
                <input type="hidden" name="unchecked_products[]" value="<?php echo $product['product_id']; ?>">
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
    <button type="submit" class="btn btn-primary">Dodaj proizvode</button>
</form>


<?php require_once 'inc/footer.php'; ?>
