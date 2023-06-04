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

    /**
     * returns the surname of the user with the given id
     * @param $id_user
     * @return mixed
     */
    static function getSurname($id_user){
        $db = DB::connexion();
        $request = 'SELECT surname_user FROM "user" WHERE id_user=:id_user;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_user', $id_user);
        $statement->execute();

        return $statement->fetch()[0];
    }

    /**
     * returns the birthdate of the user with the specified id
     * not the age
     * @param $id_user
     * @return mixed
     */
    static function getBirthdate($id_user){
        $db = DB::connexion();
        $request = 'SELECT birthdate_user FROM "user" WHERE id_user=:id_user;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_user', $id_user);
        $statement->execute();

        return $statement->fetch()[0];
    }

    /**
     * returns the email of the user with the specified id
     * @param $id_user
     * @return string or NULL
     */
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

    /**
     * returns the IDs of the playlists from the specified user
     * @param $id_user
     * @return array
     */
    static function getPlaylistsList($id_user){
        //TODO
    }


    static function getIdFavPlaylist($id_user){
        try{
            $db = DB::connexion();
            $id_user = intval($id_user);

            $request = 'SELECT p.id_playlist FROM user_playlist
                   JOIN playlist p on p.id_playlist = user_playlist.id_playlist
                   WHERE id_user = :id_user
                    AND is_fav;';
            $statement = $db->prepare($request);
            $statement->bindParam(':id_user', $id_user);
            $statement->execute();

            return $statement->fetch()[0];
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    }

    static function getLikedSongs($id_user){
        try{
            $db = DB::connexion();
            $id_user = intval($id_user);

            $id_fav_playlist = User::getIdFavPlaylist($id_user);

            $request = 'SELECT s.id_song, title_song, link_song, duration_song, date_add_song_playlist, name_album, cover_album 
                            FROM playlist_song 
                                JOIN playlist p on p.id_playlist = playlist_song.id_playlist 
                                JOIN song s on playlist_song.id_song = s.id_song 
                                JOIN album a on a.id_album = s.id_album 
                            WHERE p.id_playlist = :id_playlist;';
            $statement = $db->prepare($request);
            $statement->bindParam(':id_playlist', $id_fav_playlist);
            $statement->execute();




            $arr = $statement->fetchAll(PDO::FETCH_ASSOC);

            $arr2 = [];
            foreach ($arr as $song){
                $is_liked = Song::isLikedByUser($song['id_song'], $id_user);
                $song["is_liked"] = $is_liked;
                $arr2[] = $song;
            }

            return $arr2;



        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }


    }

    static function getLikedSongsIds($id_user){
        try{
            $db = DB::connexion();
            $id_user = intval($id_user);

            $id_fav_playlist = User::getIdFavPlaylist($id_user);

            $request = 'SELECT id_song 
                            FROM playlist_song 
                                JOIN playlist p on p.id_playlist = playlist_song.id_playlist 
                            WHERE p.id_playlist = :id_playlist;';
            $statement = $db->prepare($request);
            $statement->bindParam(':id_playlist', $id_fav_playlist);
            $statement->execute();

            $dico = $statement->fetchAll(PDO::FETCH_ASSOC);
            $arr = array();
            foreach ($dico as $val){
                $arr[] = $val['id_song']; //array push
            }
            return $arr;
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
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

    static function addSongToUserHistory($id_user, $id_song){
        try {
            $db = DB::connexion();
            $id_user = intval($id_user);
            $id_song = intval($id_song);
            $request = 'INSERT INTO history(id_song, id_user) VALUES (:id_song, :id_user);';
            $statement = $db->prepare($request);
            $statement->bindParam(':id_song', $id_song);
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


    static function addFav($id_user, $id_song){
        try{
            $db = DB::connexion();
            $id_user = intval($id_user);
            $id_song = intval($id_song);

            $id_fav_playlist = User::getIdFavPlaylist($id_user);
            $request = 'INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) VALUES (:id_playlist, :id_song, CURRENT_DATE);';
            $statement = $db->prepare($request);
            $statement->bindParam(':id_playlist', $id_fav_playlist);
            $statement->bindParam(':id_song', $id_song);
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