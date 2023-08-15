<?php
require_once "app/config/config.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Eshop - <?= $pageTittle; ?></title>
</head>
<body>



<?php if(isset($_SESSION['servermsg'])): ?>
    <div class="alert alert-info alert-dismissible"> <?= $_SESSION['servermsg'];
    unset($_SESSION['servermsg']);
    ?>  </div>

<?php endif; ?>

<?php require_once "inc/top_navbar.php"?>

    <div class="container">

