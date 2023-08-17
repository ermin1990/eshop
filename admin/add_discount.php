<?php
require_once 'inc/header.php';
require_once('../app/classes/Discount.php');
require_once('../app/classes/User.php');

$discount = new Discount();
$all_discounts = $discount->get_all_discounts();


$user = new User();
if(!$user->is_admin($_SESSION['user_id'])){
    header("Location: ../index.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Ovdje koristite svoju klasu za manipulaciju s bazom podataka
    $discount->create_discount($name, $start_date, $end_date);

    // Nakon što dodate popust, preusmjerite se na odgovarajuću stranicu
    header("Location: discounts.php");
    exit();
}



?>
<div class="container mt-5 col-md-8 col-xl-5">
    <h2 class="display-5">Dodaj novu akciju</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="name">Naziv akcije</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="start_date">Početni Datum</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>
        <div class="form-group">
            <label for="end_date">Završni Datum</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary" >Dodaj akciju</button>
    </form>
</div>

<?php require_once 'inc/footer.php'; ?>

