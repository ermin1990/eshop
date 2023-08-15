<?php

require_once "app/classes/User.php";
$pageTittle = "Login";
require_once "inc/header.php";



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $create = $user->login($username, $password);


if ($create){
    $_SESSION['servermsg'] = "Uspješno ste ulogovani!";
    header("Location: index.php");
    exit();
}else{
     header("Location: login.php");
     exit();
}
}




?>








<form class="registration-form setinmiddle" method="POST" action="">
    <h2>Login</h2>
    <input type="text" placeholder="Username" name="username" required>
    <input type="password" placeholder="Lozinka" name="password" required>
    <button class="call-to-action" type="submit">Prijavi se</button>
    <label class="alert alert-info mt-2 d-flex">Ukoliko nemate račun,<a class="nav-link" href="register.php"><strong> kreirajte ga!</strong></a> </label>
</form>


<?php require_once "inc/footer.php"; ?>