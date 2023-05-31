<?php
require_once "../../DB.php";
class User
{
    /**
     * retourne le nom de l'utilisateur dont l'id est passé en argument
     * @param $id_user
     * @return mixed
     */
    static function getName($id_user){
        $db = DB::connexion();
        $request = 'SELECT name_user FROM "user" WHERE id_user=:id_user;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_user', $id_user);
        $statement->execute();

        return $statement->fetch()[0];
    }


    static function getSurname($id_user){
        $db = DB::connexion();
        $request = 'SELECT surname_user FROM "user" WHERE id_user=:id_user;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_user', $id_user);
        $statement->execute();

        return $statement->fetch()[0];
    }


    static function getBirthdate($id_user){
        $db = DB::connexion();
        $request = 'SELECT birthdate_user FROM "user" WHERE id_user=:id_user;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_user', $id_user);
        $statement->execute();

        return $statement->fetch()[0];
    }


    static function getEmail($id_user){
        $db = DB::connexion();
        $request = 'SELECT email_user FROM "user" WHERE id_user=:id_user;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_user', $id_user);
        $statement->execute();

        return $statement->fetch()[0];
    }
}