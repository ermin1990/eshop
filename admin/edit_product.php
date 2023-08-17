<?php

$pageTittle = "- Edit product";
require_once 'inc/header.php';
require '../app/classes/User.php';
require_once '../app/classes/Product.php';

$user = new User();
$product = new Product();


if(!$user->is_admin($_SESSION['user_id'])){
    header("Location: ../index.php");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
$product_id = $_POST['product_id'];
$name = $_POST['name'];
$price = $_POST['price'];
$size = $_POST['size'];

if ($product->update($product_id, $name, $price, $size)) {
        $_SESSION['servermsg'] = "Proizvod uspješno ažuriran";
        header("Location: products.php");
        exit();
    } else {
        $_SESSION['servermsg'] = "Greška prilikom ažuriranja proizvoda!";
        header("Location: edit_product.php?id=".$product_id);
    }
}

$product_id = $_GET['id'] ?? '';
$product_data = $product->get_one_product($product_id);

if (!$product_data) {
    $_SESSION['servermsg'] = "Proizvod ne postoji";
    header("Location: products.php");
    exit();
}

?>

<div class="container mt-5 col-md-6 col-xl-5">
    <h2 class="display-5">Edit Product</h2>
    <form action="" method="post">
        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $product_data['name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo $product_data['price']; ?>" required>
        </div>
        <div class="form-group">
            <label for="size">Size</label>
            <input type="text" class="form-control" id="size" name="size" value="<?php echo $product_data['size']; ?>" required>
        </div>
        <br>
        <button type="submit" name="update" class="btn btn-primary">Ažuriraj podatke</button>
    </form>
</div>

<?php require_once 'inc/footer.php'; ?>