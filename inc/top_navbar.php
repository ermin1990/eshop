<!-- Navbar -->
<?php

require_once ('app/classes/User.php');

$user = new User();

?>

<nav class="navbar navbar-expand-lg navbar-light p-3 mainMenu">
    <div class="container">
    <a class="navbar-brand h3" href="index.php">Shop projekat</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Početna</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="discounts.php">Akcije</a>
            </li>
        </ul>

        <div class="flex-grow-1"></div> <!-- Pravimo prazan prostor između stavki menija -->

        <ul class="navbar-nav ml-auto"> <!-- Koristimo ml-auto klasu za stavke koje želimo gurnuti do kraja -->
            <?php if ($user->is_loggedIn()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">Korpa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="orders.php">Moje narudžbe</a>
                </li>
                <li class="nav-link">
                    <a class="btn btn-danger" href="logout.php">Logout</a>
                </li>
                <?php if ($user->is_loggedIn() && $user->is_admin($_SESSION['user_id'])):?>
                    <li class="nav-link">
                    <a class="btn btn-dark" href="admin/products.php">Admin dashboard</a>
                </li>
                <?php endif ?>

            <?php else: ?>
                <li class="nav-link">
                    <a class="btn btn-success" href="login.php">Login</a>
                </li>
            <?php endif ?>
        </ul>
    </div>
    </div>

</nav>


