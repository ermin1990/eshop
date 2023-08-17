<?php

require_once 'inc/header.php';
require '../app/classes/User.php';

$user = new User();

if(!$user->is_admin()){
    header("Location: ../index.php");
}


require_once 'inc/footer.php';


