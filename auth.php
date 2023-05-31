<?php
session_start();

require_once 'DB.php';

function auth_verif(){
    $db = DB::connexion();
    if (empty($_SESSION['id_user'])){

        if (isset($_POST['username'], $_POST['password'])){
            $username = $_POST['username'];
            $password = password_hash($_POST['password']);

            $request = '
            SELECT id_user FROM client 
            WHERE email =:username AND mdp=crypt(:password,mdp)
            ';
            $statement = $db->prepare($request);
            $statement->bindParam(':username', $username);
            $statement->bindParam(':password', $password);
            $statement->execute();

            $result = $statement->fetch();

            if (!empty($result['id_user'])){
                $_SESSION['id_user'] = $result['id_user'];
                return 'connected';
            }else{
                return "incorrect";
            }
        }
        else{
            return "not connected";
        }
    }
    return "connected";
}
