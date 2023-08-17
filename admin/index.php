<?php

require_once 'inc/header.php';
require '../app/classes/User.php';

$user = new User();

if(!$user->is_admin($_SESSION['user_id'])){
    header("Location: ../index.php");
}
?>
<h3>Za sada ovdje nije ništa implementirano</h3>


<?php
require_once 'inc/footer.php';


