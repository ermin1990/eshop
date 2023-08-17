<?php
$pageTittle = "- Add new product";
require_once 'inc/header.php';
require '../app/classes/User.php';
require_once '../app/classes/Product.php';

$user = new User();
$product = new Product();


if(!$user->is_admin($_SESSION['user_id'])){
    header("Location: ../index.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Pripremite podatke za unos
    $name = $_POST['name'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $image = $_FILES['image']['name'];
    $target = "../public/images/" . basename($image);

    if ($product->add_new_product($name, $price, $size, $image, $target)) {
        $_SESSION['servermsg'] = "Produkt uspješno dodan";
        header("Location: products.php");
        exit();
    } else {
        $_SESSION['servermsg'] = "Greška prilikom dodavanja artikla!";
        exit(); // Odmah prekinite izvršenje skripte nakon preusmjeravanja
    }
}

?>


<div class="container mt-5 col-md-6 col-xl-5">
    <h2 class="display-5">Add New Product</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="size">Size</label>
            <input type="text" class="form-control" id="size" name="size" required>
        </div>
        <div class="form-group">
            <br>
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>






<?php require_once 'inc/footer.php'; ?>