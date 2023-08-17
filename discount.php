<?php


$pageTittle = "- Akcije";
require_once 'inc/header.php';
require_once('app/classes/Discount.php');
require_once('app/classes/Product.php');
require_once('app/classes/Utils.php');

$discount = new Discount();
if (isset($_GET['id'])) {
    $discount_id = $_GET['id'];

} else {
    echo "Invalid discount ID.";
    exit;
}

$products = $discount->get_one_discount_with_product($discount_id);
$thisDiscount = $discount->get_one_discount($discount_id);

$utils = new Utils();
?>


<!-- Prikaz informacija o akciji -->
<h2 class="display-3"><?php echo $thisDiscount['name']; ?></h2>
<p>Akcija traje u periodu: <?php echo $utils->format_date($thisDiscount['start_date']); ?> - <?php echo $utils->format_date($thisDiscount['end_date']); ?></p>


<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-3">
    <?php foreach ($products as $product) : ?>
        <div class="col">
            <div class="card h-100">
                <img src="public/images/<?php echo $product['image']; ?>" class="card-img-top" alt="Product Image" style="object-fit: cover; height: 200px;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $product['naziv_artikla']; ?></h5>
                    <p class="card-text" style="font-size: 18px;">$<?php echo $product['price']; ?></p>
                    <p class="card-text">Size: <?php echo $product['size']; ?></p>
                </div>
                <div class="card-footer">
                    <a href="product.php?id=<?= $product['product_id']; ?>" class="btn btn-success">View</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>


