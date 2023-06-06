<?php
session_start();
session_destroy();

//redirect
header("Location: accueil.php");

?>

