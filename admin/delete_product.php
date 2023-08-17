<?php
require_once '../app/config/config.php';
require_once '../app/classes/Product.php';
$p = new Product();
$product_id = $_GET['id'];

$p->delete($product_id);

header("Location: products.php");