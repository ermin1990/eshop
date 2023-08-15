<!-- Navbar -->
<?php

require_once 'app/classes/User.php';

$user = new User();

?>

<nav class="navbar navbar-expand-lg navbar-light p-3 mainMenu">
    <a class="navbar-brand" href="index.php">Shop projekat</a>
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
                <a class="nav-link" href="products.php">Proizvodi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="discounts.php">Akcije</a>
            </li>

            <?php if ($user->is_loggedIn()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">Korpa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="orders.php">Moje narudžbe</a>
                </li>
                <li><a class="btn btn-danger" href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a class="btn btn-warning" href="login.php">Login</a></li>
            <?php endif ?>

        </ul>
    </div>
</nav>
