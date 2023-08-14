<?php
require_once "app/classes/User.php";
require_once "inc/header.php";


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new User();

    $create = $user->createUser($name,$username,$email,$password);

    if ($create){
        echo "Uspješno kreiraj user";
    }else{
        echo "Neuspješno kreiran user";
    }

}


?>

    <form class="registration-form" method="POST" action="">
        <h2>Registracija</h2>
        <input type="text" placeholder="Ime i prezime" name="name" required>
        <input type="email" placeholder="Email adresa" name="email" required>
        <input type="text" placeholder="Username" name="username" required>
        <input type="password" placeholder="Lozinka" name="password" required>
        <button class="call-to-action" type="submit">Registruj se</button>
    </form>


<?php require_once "inc/footer.php"; ?>