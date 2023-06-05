<?php
require_once "../../DB.php";
/**
 * Class User
 */
class User
{
    /**
     * Fonction qui retourne le prénom de l'utilisateur dont l'id est passé en argument
     * @param $id_user
     * @return mixed
     */
    static function getName($id_user){
        $db = DB::connexion();

        $request = 'SELECT name_user 
                    FROM "user" 
                    WHERE id_user=:id_user;';

        $statement = $db->prepare($request);

        $statement->bindParam(':id_user', $id_user);

        $statement->execute();

        return $statement->fetch()[0];
    }

    /**
     * Fonction qui retourne le nom de l'utilisateur dont l'id est passé en argument
     * @param $id_user
     * @return mixed
     */
    static function getSurname($id_user){
        $db = DB::connexion();

        $request = 'SELECT surname_user 
                    FROM "user" 
                    WHERE id_user=:id_user;';

        $statement = $db->prepare($request);

        $statement->bindParam(':id_user', $id_user);

        $statement->execute();

        return $statement->fetch()[0];
    }

    /**
     * Fonction qui retourne la date de naissance de l'utilisateur dont l'id est passé en argument
     * et non son age
     * @param $id_user
     * @return mixed
     */
    static function getBirthdate($id_user){
        $db = DB::connexion();

        $request = 'SELECT birthdate_user 
                    FROM "user" 
                    WHERE id_user=:id_user;';

        $statement = $db->prepare($request);

        $statement->bindParam(':id_user', $id_user);

        $statement->execute();

        return $statement->fetch()[0];
    }

    /**
     * Fonction qui retourne l'email de l'utilisateur dont l'id est passé en argument
     * @param $id_user
     * @return string or NULL
     */
    static function getEmail($id_user){
        $db = DB::connexion();

        $request = 'SELECT email_user 
                    FROM "user" 
                    WHERE id_user=:id_user;';

        $statement = $db->prepare($request);

        $statement->bindParam(':id_user', $id_user);

        $statement->execute();

        return $statement->fetch()[0];
    }

    /**
     * Fonction l'id correspondant au mail passé en argument, retourne null si l'email n'existe pas encore dans la BDD
     * @param $email
     * @return mixed
     */
    static function id($email){
        $db = DB::connexion();

        $email = strval($email);

        $request = 'SELECT id_user 
                    FROM "user" 
                    WHERE email_user=:email_user;';

        $statement = $db->prepare($request);

        $statement->bindParam(':email_user', $email);

        $statement->execute();

        return $statement->fetch()[0];
    }

    /**
     * Fonction qui retourne toutes les playlists de l'utilisateur
     * @param $id_user
     * @return array
     */
    static function getPlaylistsList($id_user){
        try
        {
            $db = DB::connexion();

            $id_user = intval($id_user);

            $request = 'SELECT id_user, p.id_playlist, name_playlist, cover_playlist, is_fav, date_playlist 
                        FROM user_playlist
                        JOIN playlist p ON p.id_playlist = user_playlist.id_playlist
                        WHERE id_user=:id_user;';

            $statement = $db->prepare($request);

            $statement->bindParam(':id_user', $id_user);

            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    }
    /**
     * Fonction qui retourne l'id de la playlist "titres likés" de l'utilisateur
     * @param $id_user
     * @return mixed
     */
    static function getIdFavPlaylist($id_user){
        try
        {
            $db = DB::connexion();

            $id_user = intval($id_user);

            $request = 'SELECT p.id_playlist 
                        FROM user_playlist
                        JOIN playlist p ON p.id_playlist = user_playlist.id_playlist
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
    /**
     * Fonction qui retourne les chansons likées par l'utilisateur
     * @param $id_user
     * @return array
     */
    static function getLikedSongs($id_user){
        try
        {
            $db = DB::connexion();

            $id_user = intval($id_user);
            $id_fav_playlist = User::getIdFavPlaylist($id_user);

            $request = 'SELECT s.id_song, title_song, link_song, duration_song, date_add_song_playlist, name_album, cover_album 
                        FROM playlist_song 
                        JOIN playlist p ON p.id_playlist = playlist_song.id_playlist 
                        JOIN song s ON playlist_song.id_song = s.id_song 
                        JOIN album a ON a.id_album = s.id_album 
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
    /**
     * Fonction qui retourne les ids des chansons likées par l'utilisateur
     * @param $id_user
     * @return array
     */
    static function getLikedSongsIds($id_user){
        try
        {
            $db = DB::connexion();

            $id_user = intval($id_user);
            $id_fav_playlist = User::getIdFavPlaylist($id_user);

            $request = 'SELECT id_song 
                        FROM playlist_song 
                        JOIN playlist p ON p.id_playlist = playlist_song.id_playlist 
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
    /**
     * Fonction qui permet de récupérer toutes les informations d'un utilisateur sauf le mot de passe
     * @param $id_user
     * @return mixed
     */
    static function getAll($id_user){
        $db = DB::connexion();

        $id_user = intval($id_user);

        $request = 'SELECT id_user, name_user, surname_user, birthdate_user, email_user 
                    FROM "user" 
                    WHERE id_user = :id_user;';

        $statement = $db->prepare($request);
        $statement->bindParam(':id_user', $id_user);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC)[0];
    }
    /**
     * Fonction qui permet d'ajouter un utilisateur dans la base de données
     * @param $name, $surname, $email, $birthdate, $password
     * @return string
     */
    static function addUser($name, $surname, $email, $birthdate, $password)
    {
        if (User::id($email) == null) {

            try 
            {
                $db = DB::connexion();

                $name = strval($name);
                $surname = strval($surname);
                $birthdate = strval($birthdate);
                $password = strval($password);
                $email = strval($email);

                $request = 'INSERT INTO "user"(name_user, surname_user, birthdate_user, password_user, email_user) 
                            VALUES (:name_user, :surname_user, :birthdate_user, crypt(:password_user, gen_salt(\'md5\')) , :email_user);';
                
                $statement = $db->prepare($request);

                $statement->bindParam(':name_user', $name);
                $statement->bindParam(':surname_user', $surname);
                $statement->bindParam(':birthdate_user', $birthdate);
                $statement->bindParam(':password_user', $password);
                $statement->bindParam(':email_user', $email);

                $statement->execute();

                return "ok";
            } 
            catch (PDOException $exception) 
            {
                error_log('Request error: ' . $exception->getMessage());
                return "error";
            }
        } else {
            return "email already exists";
        }
    }
    /** 
     * Fonction qui permet de mettre à jour l'email d'un utilisateur
     * @param $id_user, $email_user
     * @return bool
     */
    static function updateEmail($id_user, $email_user){
        try 
        {
            $db = DB::connexion();

            $id_user = intval($id_user);
            $email_user = strval($email_user);

            $request = 'UPDATE "user" 
                        SET email_user = :email_user 
                        WHERE id_user = :id_user;';

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
    /**
     * Fonction qui permet de mettre à jour le prénom d'un utilisateur 
     * @param $id_user, $name_user
     * @return bool 
     */
    static function updateName($id_user, $name_user){
        try {

            $db = DB::connexion();

            $id_user = intval($id_user);
            $name_user = strval($name_user);

            $request = 'UPDATE "user" 
                        SET name_user = :name_user 
                        WHERE id_user = :id_user;';

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
    /**
     * Fonction qui permet de mettre à jour le nom de famille d'un utilisateur
     * @param $id_user, $surname_user
     * @return bool
     */
    static function updateSurname($id_user, $surname_user){
        try 
        {
            $db = DB::connexion();
            $id_user = intval($id_user);
            $surname_user = strval($surname_user);

            $request = 'UPDATE "user" 
                        SET surname_user = :surname_user 
                        WHERE id_user = :id_user;';

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
    /**
     * Fonction qui permet de mettre à jour le mot de passe d'un utilisateur
     * @param $id_user, $password_user
     * @return bool
     */
    static function updatePassword($id_user, $password_user){
        try 
        {
            $db = DB::connexion();

            $id_user = intval($id_user);
            $password_user = strval($password_user);

            $request = 'UPDATE "user" 
                        SET password_user = crypt(:password_user, gen_salt(\'md5\')) 
                        WHERE id_user = :id_user;';

            $statement = $db->prepare($request);

            $statement->bindParam(':id_user', $id_user);
            $statement->bindParam(':password_user', $password_user);

            $statement->execute();

            return true;
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    }
    /**
     * Fonction qui permet de mettre à jour la date de naissance d'un utilisateur
     * @param $id_user, $birthdate_user
     * @return bool
     */
    static function updateBirthdate($id_user, $birthdate_user){
        try 
        {
            $db = DB::connexion();

            $id_user = intval($id_user);
            $birthdate_user = strval($birthdate_user);

            $request = 'UPDATE "user" 
                        SET birthdate_user = :birthdate_user 
                        WHERE id_user = :id_user;';

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
    /**
     * Fonction qui 
     */
    static function addFav($id_user, $id_song){
        try{
            $db = DB::connexion();

            $id_user = intval($id_user);
            $id_song = intval($id_song);

            $liked_arr = User::getLikedSongsIds($id_user);
            if (!in_array($id_song, $liked_arr)){
                $id_fav_playlist = User::getIdFavPlaylist($id_user);

                $request = 'INSERT INTO playlist_song(id_playlist, id_song, date_add_song_playlist) 
                            VALUES (:id_playlist, :id_song, CURRENT_DATE);';
                
                $statement = $db->prepare($request);

                $statement->bindParam(':id_playlist', $id_fav_playlist);
                $statement->bindParam(':id_song', $id_song);

                $statement->execute();

                return true;
            }else{
                return User::deleteFav($id_user, $id_song);
            }


        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    }
    /** 
     * Fonction qui permet de supprimer une musique des favoris d'un utilisateur
     * @param $id_user, $id_song
     * @return bool
     */
    static function deleteFav($id_user, $id_song)
    {
        try 
        {
            $db = DB::connexion();

            $id_user = intval($id_user);
            $id_song = intval($id_song);

            $id_fav_playlist = User::getIdFavPlaylist($id_user);

            $request = 'DELETE FROM playlist_song 
                        WHERE id_song=:id_song 
                        AND id_playlist=:id_playlist;';

            $statement = $db->prepare($request);

            $statement->bindParam(':id_playlist', $id_fav_playlist);
            $statement->bindParam(':id_song', $id_song);

            $statement->execute();

            return true;
        } 
        catch (PDOException $exception) 
        {
            error_log('Request error: ' . $exception->getMessage());
            return false;
        }
    }
    /**
     * Fonction qui permet d'ajouter une musique à l'historique d'un utilisateur, si la musique est déjà présente dans l'historique, elle est supprimée et réinsérée
     * @param $id_user, $id_song
     * @return bool
     */
    static function addToHistory($id_user, $id_song){
        try
        {
            $db = DB::connexion();
            
            $id_user = intval($id_user);
            $id_song = intval($id_song);

            // Vérifier si la musique est déjà présente dans l'historique de l'utilisateur
            $checkRequest = 'SELECT id_song 
                            FROM history 
                            WHERE id_song = :id_song 
                            AND id_user = :id_user;';

            $checkStatement = $db->prepare($checkRequest);

            $checkStatement->bindParam(':id_song', $id_song);
            $checkStatement->bindParam(':id_user', $id_user);

            $checkStatement->execute();
            $existingEntry = $checkStatement->fetch(PDO::FETCH_ASSOC);

            // Si la musique est déjà présente, supprimer l'entrée existante
            if ($existingEntry) {
                $deleteRequest = 'DELETE FROM history 
                                  WHERE id_song = :id;';

                $deleteStatement = $db->prepare($deleteRequest);

                $deleteStatement->bindParam(':id', $existingEntry['id_song']);
                $deleteStatement->execute();
            }

            // Ajouter la musique à l'historique
            $insertRequest = 'INSERT INTO history (id_song, id_user, date_add_song_history) 
                              VALUES (:id_song, :id_user, NOW());';

            $insertStatement = $db->prepare($insertRequest);

            $insertStatement->bindParam(':id_song', $id_song);
            $insertStatement->bindParam(':id_user', $id_user);

            $insertStatement->execute();

            return true;
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    }
    /**
     * Fonction qui permet de récupérer l'historique d'un utilisateur (10 dernières musiques écoutées)
     * @param $id_user
     * @return array|bool
     */
    static function getHistory($id_user){
        try
        {
            $db = DB::connexion();

            $request = 'SELECT history.id_song, title_song, duration_song, link_song, song.id_album, name_album, cover_album
                        FROM history
                        JOIN song ON history.id_song = song.id_song
                        JOIN album a ON song.id_album = a.id_album
                        WHERE id_user = :id_user
                        ORDER BY date_add_song_history DESC
                        LIMIT 10;';

            $statement = $db->prepare($request);

            $statement->bindParam(':id_user', $id_user);

            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    }
}