<?php
require_once "../models/auth.php";
require_once "../models/DB.php";

session_start();
$auth = auth_verif();

switch ($auth) {
    case "connected":

        //require_once "../views/nav.php";
        echo "<h1>CONNECTED</h1>";
        //require_once "../views/footer.php";

        break;

    case "incorrect":
        $displayConnectionError = "";

    default:
        require_once "../connexion.php";
        break;
}
