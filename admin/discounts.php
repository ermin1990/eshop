<?php


$pageTittle = "- Akcije";
require_once 'inc/header.php';
require_once('../app/classes/Discount.php');
require_once('../app/classes/User.php');

$discount = new Discount();
$all_discounts = $discount->get_all_discounts();

$user = new User();
if(!$user->is_admin($_SESSION['user_id'])){
    header("Location: ../index.php");
}
?>

<div class="container mt-5">
    <h2 class="display-5">Akcije</h2>
    <a href="add_discount.php" class="btn btn-primary mb-3">Dodaj novu akciju</a>

    <?php if (count($all_discounts) > 0) : ?>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Naziv akcije</th>
                <th scope="col">Početak akcije</th>
                <th scope="col">Kraj akcije</th>
                <th scope="col">Akcije</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($all_discounts as $index => $discount) : ?>
                <tr>
                    <th scope="row"><?php echo $index + 1; ?></th>
                    <td><?php echo $discount['name']; ?></td>
                    <td><?php echo $discount['start_date']; ?></td>
                    <td><?php echo $discount['end_date']; ?></td>

                    <td>
                        <a href="add_products_discount.php?id=<?php echo $discount['discount_id']; ?>" class="btn btn-info btn-sm">Dodaj artikle</a>
                        <!--<a href="edit_discount.php?id=<?php /*echo $discount['discount_id']; */?>" class="btn btn-warning btn-sm">Edit</a>-->

                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No discounts available.</p>
    <?php endif; ?>
</div>


<?php require_once 'inc/footer.php'; ?>


