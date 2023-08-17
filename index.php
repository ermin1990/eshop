<?php

$pageTittle = "- Naslovna";
require_once ("inc/header.php");



//Klase
require_once 'app/classes/Product.php';
$products = new Product();

$allproducts = $products->get_all();


require_once 'discounts.php';
?>


    <div class="row row-cols-2 row-cols-md-2 row-cols-lg-4 g-4 mt-3">
        <?php foreach ($allproducts as $product) : ?>
            <div class="col">
                <div class="card">
                    <div class="img-container">
                        <img src="public/images/<?php echo $product['image']; ?>" class="card-img-top img-cover">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['name']; ?></h5>
                        <p class="card-text">Size: <?php echo $product['size']; ?></p>
                    </div>
                    <div class="card-footer">
                        <a href="product.php?id=<?= $product['product_id'] ?>" class="btn btn-success float-start">View</a>
                        <span class="btn btn-info float-end"><strong>€ </strong><?php echo $product['price']; ?></span>
                        <!--<a href="#" class="btn btn-primary float-end disabled">Add to Cart</a>-->
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>




<?php require_once "inc/footer.php"; ?>