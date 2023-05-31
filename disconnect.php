<?php
session_start();
session_destroy();

//redirect
header("Location: client/accueil.php");

//TODO changer racine site
?>

