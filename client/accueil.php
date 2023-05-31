<?php
require_once "../auth.php";
require_once "../DB.php";

session_start();
$auth = auth_verif();

switch ($auth) {
    case "connected":
        header("Location: accueil.html");
        break;

    case "incorrect":
        $displayConnectionError = "";

    default:
        require_once "connexion.php";
        break;
}

