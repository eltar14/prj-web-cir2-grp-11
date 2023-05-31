<?php
require_once "../auth.php";
require_once "../DB.php";

session_start();
$auth = auth_verif();

switch ($auth) {
    case "connected":

        require_once "nav.php";
        // require once fichier html
        echo "<h1>CONNECTED</h1>";
        //require_once "../views/footer.php";
        header("Location: accueil.html");

        break;

    case "incorrect":
        echo "incorrect !";
        $displayConnectionError = "";

    default:
        echo "default";
        require_once "connexion.php";
        break;
}

