<?php

$pageTittle = "- Akcije";
require_once 'inc/header.php';
require_once('app/classes/Discount.php');
require_once('app/classes/Utils.php');


$discount = new Discount();
$utils = new Utils();
$discounts = $discount->get_all_discounts();

?>




<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-3">
    <?php foreach ($discounts as $discount) : ?>
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $discount['name']; ?></h5>
                    <p class="card-text">Start: <?php echo $utils->format_date($discount['start_date']); ?></p>
                    <p class="card-text">End: <?php echo $utils->format_date($discount['end_date']); ?></p>
                </div>
                <div class="card-footer">
                    <a href="discount.php?id=<?php echo $discount['discount_id']; ?>" class="btn btn-primary">Pogledaj akciju</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

