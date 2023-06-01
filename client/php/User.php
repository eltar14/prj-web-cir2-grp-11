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

    /**
     * retourne l'id correspondant au mail passé en argument, retourne null si l'email n'existe pas encore dans la BDD
     * @param $email
     * @return mixed
     */
    static function id($email){
        $db = DB::connexion();
        $email = strval($email);
        $request = 'SELECT id_user FROM "user" WHERE email_user=:email_user;';
        $statement = $db->prepare($request);
        $statement->bindParam(':email_user', $email);
        $statement->execute();

        return $statement->fetch()[0];
    }

    static function getPlaylistsList($id_user){
        //TODO
    }

    static function getAll($id_user){
        $db = DB::connexion();
        $id_user = intval($id_user);
        $request = 'SELECT id_user, name_user, surname_user, birthdate_user, email_user FROM "user" WHERE id_user = :id_user;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_user', $id_user);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC)[0];
    }
    static function addUser($name, $surname, $email, $birthdate, $password)
    {
        if (User::id($email) == null) {

            try {
                $db = DB::connexion();

                $name = strval($name);
                $surname = strval($surname);
                $birthdate = strval($birthdate);
                $password = strval($password);
                $email = strval($email);


                $request = 'INSERT INTO "user"(name_user, surname_user, birthdate_user, password_user, email_user) values (:name_user, :surname_user, :birthdate_user, crypt(:password_user, gen_salt(\'md5\')) , :email_user);';
                $statement = $db->prepare($request);

                $statement->bindParam(':name_user', $name);
                $statement->bindParam(':surname_user', $surname);
                $statement->bindParam(':birthdate_user', $birthdate);
                $statement->bindParam(':password_user', $password);
                $statement->bindParam(':email_user', $email);
                $statement->execute();

                return "ok";
            } catch (PDOException $exception) {
                error_log('Request error: ' . $exception->getMessage());
                return "error";
            }
        } else {
            return "email already exists";
        }
    }


    static function updateEmail($id_user, $email_user){
        try {
            $db = DB::connexion();
            $id_user = intval($id_user);
            $email_user = strval($email_user);

            $request = 'UPDATE "user" SET email_user = :email_user WHERE id_user = :id_user;';
            $statement = $db->prepare($request);
            $statement->bindParam(':email_user', $email_user);
            $statement->bindParam(':id_user', $id_user);
            $statement->execute();

            return true;
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    }

    static function updateName($id_user, $name_user){
        try {
            $db = DB::connexion();
            $id_user = intval($id_user);
            $name_user = strval($name_user);

            $request = 'UPDATE "user" SET name_user = :name_user WHERE id_user = :id_user;';
            $statement = $db->prepare($request);
            $statement->bindParam(':name_user', $name_user);
            $statement->bindParam(':id_user', $id_user);
            $statement->execute();

            return true;
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    }


    static function updateSurname($id_user, $surname_user){
        try {
            $db = DB::connexion();
            $id_user = intval($id_user);
            $surname_user = strval($surname_user);

            $request = 'UPDATE "user" SET surname_user = :surname_user WHERE id_user = :id_user;';
            $statement = $db->prepare($request);
            $statement->bindParam(':surname_user', $surname_user);
            $statement->bindParam(':id_user', $id_user);
            $statement->execute();

            return true;
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    }

    static function updatePassword($id_user, $password_user){
        try {
            $db = DB::connexion();
            $id_user = intval($id_user);
            $password_user = strval($password_user);

            $request = 'UPDATE "user" SET password_user = crypt(:password_user, gen_salt(\'md5\')) WHERE id_user = :id_user;';
            $statement = $db->prepare($request);
            $statement->bindParam(':id_user', $id_user);
            $statement->bindParam(':password_user', $password_user);

            return true;
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    }

    static function updateBirthdate($id_user, $birthdate_user){
        try {
            $db = DB::connexion();
            $id_user = intval($id_user);
            $birthdate_user = strval($birthdate_user);

            $request = 'UPDATE "user" SET birthdate_user = :birthdate_user WHERE id_user = :id_user;';
            $statement = $db->prepare($request);
            $statement->bindParam(':birthdate_user', $birthdate_user);
            $statement->bindParam(':id_user', $id_user);
            $statement->execute();

            return true;
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    }

}