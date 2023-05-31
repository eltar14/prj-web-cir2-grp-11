<?php
session_start();

require_once 'DB.php';

function auth_verif(){
    $db = DB::connexion();
    if (empty($_SESSION['id_user'])){

        if (isset($_POST['username'], $_POST['password'])){
            $username = $_POST['username'];
            $password = $_POST['password'];

            $request = '
            SELECT id_user FROM "user" 
            WHERE email_user =:email_user AND password_user=crypt(:password_user,password_user)
            ';
            $statement = $db->prepare($request);
            $statement->bindParam(':email_user', $username);
            $statement->bindParam(':password_user', $password);
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
