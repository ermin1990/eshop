<?php ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3 mainMenu">
    <div class="container">
    <a class="navbar-brand h3" href="../index.php">Back to Web shop</a>
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
            <li class="nav-item">
                <a class="nav-link" href="allorders.php">Sve narudžbe</a>
            </li>
        </ul>

        <div class="flex-grow-1"></div> <!-- Pravimo prazan prostor između stavki menija -->

        <ul class="navbar-nav ml-auto"> <!-- Koristimo ml-auto klasu za stavke koje želimo gurnuti do kraja -->

                <li class="nav-item">
                    <a class="btn btn-danger" href="../logout.php">Logout</a>
                </li>

        </ul>
    </div>
    </div>

</nav>