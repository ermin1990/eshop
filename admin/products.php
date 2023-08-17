<?php



$pageTittle = " - Products";
require_once 'inc/header.php';
require_once '../app/classes/Product.php';
require_once '../app/classes/User.php';

$user = new User();

if(!$user->is_admin($_SESSION['user_id'])){
    header("Location: ../index.php");
}

$product = new Product();
$products = $product->get_all();

?>


<div class="container mt-5">
    <h3 class="display-5">Products Management</h3>
    <a href="add_product.php" class="btn btn-primary mb-3">Add New Product</a>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Size</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Prikaz svih proizvoda iz baze podataka
        foreach ($products as $product) {
            echo '<tr class="align-baseline">';
            echo '<td>' . $product['product_id'] . '</td>';
            echo '<td>' . $product['name'] . '</td>';
            echo '<td>' . $product['size'] . '</td>';
            echo '<td>' . $product['price'] . '</td>';
            echo '<td>';
            echo '<a href="edit_product.php?id=' . $product['product_id'] . '" class="btn btn-sm btn-warning m-1">Edit</a>';
            echo '<a href="delete_product.php?id=' . $product['product_id'] . '" class="btn btn-sm btn-danger m-1">Delete</a>';
            echo '</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>



<?php require_once 'inc/footer.php'; ?>