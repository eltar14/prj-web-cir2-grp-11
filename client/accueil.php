<?php
require_once "../auth.php";
require_once "../DB.php";

session_start();
$auth = auth_verif();

switch ($auth) {
    case "connected":
        require_once "accueil.html";
        echo "<div id='id_user' style='display: none'>$_SESSION[id_user]</div>";
        //header("Location: accueil.html");
        break;

    case "incorrect":
        $displayConnectionError = "";

    default:
        require_once "connexion.php";
        break;
}

